<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use
	Bitrix\Main\Application,
	Bitrix\Main\Web\Uri,
	Bitrix\Main\Loader,
	Bitrix\Main\Entity\Query,
	Bitrix\Catalog\CatalogIblockTable,
	Bitrix\Iblock\IblockTable,
	Bitrix\Iblock\SectionTable,
	Bitrix\Iblock\SectionElementTable,
	Bitrix\Iblock\ElementTable,
	Bitrix\Iblock\PropertyTable;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loader::includeModule('iblock');
Loader::includeModule('catalog');
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$request    = Application::getInstance()->getContext()->getRequest();
$uri        = new Uri($request->getRequestUri());

$iblockType         = $arParams['IBLOCK_TYPE'];
$iblockId           = (int) $arParams['IBLOCK_ID'];
$iblockName         = '';
$iblockDescription  = '';

$offersIblockType   = '';
$offersIblockId     = 0;
$skuPropertyId      = 0;
$offersIblockProps  = [];

$currentSectionId           = 0;
$currentSectionCode         = '';
$currentSectionName         = '';
$currentSectionParent       = '';
$currentSectionDescription  = '';
$currentSectionDepthParams  = [];
$currentSectionSubsections  = [];
$currentSectionItems        = [];
$currentSectionOffers       = [];

$currentOfferId         = 0;
$currentOfferCode       = '';
$currentOfferName       = '';

$currentItemId          = 0;
$currentItemCode        = '';
$currentItemName        = '';
$currentItemSectionId   = 0;

$useSectionCodeUrl  = strpos($arResult['URL_TEMPLATES']['section'], '#SECTION_CODE#')   !== false;
$useSectionIdUrl    = strpos($arResult['URL_TEMPLATES']['section'], '#SECTION_ID#')     !== false;
$useItemCodeUrl     = strpos($arResult['URL_TEMPLATES']['element'], '#ELEMENT_CODE#')   !== false;
$useItemIdUrl       = strpos($arResult['URL_TEMPLATES']['element'], '#ELEMENT_ID#')     !== false;

$sectionFilterName      = 'CATALOG_SECTION_WITH_OFFERS_FILTER';
$urlVariable            = explode('/', $uri->getPath())[1];
$sectionsChain          = [];
$smartFilterUrlValue    = '';
$pageType               = '';

if( $iblockId <= 0 ) return;
/** **********************************************************************
 ************************ offers iblock info query ***********************
 ************************************************************************/
$query = new Query(CatalogIblockTable::getEntity());
$query->setSelect(['IBLOCK_ID', 'SKU_PROPERTY_ID']);
$query->setFilter(['PRODUCT_IBLOCK_ID' => $iblockId]);

foreach( $query->exec()->fetchAll() as $item )
{
	$offersIblockId = (int) $item['IBLOCK_ID'];
	$skuPropertyId  = (int) $item['SKU_PROPERTY_ID'];

	$subQuery = new Query(IblockTable::getEntity());
	$subQuery->setSelect(['IBLOCK_TYPE_ID']);
	$subQuery->setFilter
	([
		'ID'        => $offersIblockId,
		'ACTIVE'    => 'Y'
	]);

	foreach( $subQuery->exec()->fetchAll() as $subItem )
		$offersIblockType = $item['IBLOCK_TYPE_ID'];
}
/** **********************************************************************
 *************************** iblock info query ***************************
 ************************************************************************/
$query = new Query(IblockTable::getEntity());
$query->setSelect(['NAME', 'DESCRIPTION']);
$query->setFilter
([
	'IBLOCK_TYPE_ID'    => $iblockType,
	'ID'                => $iblockId,
	'ACTIVE'            => 'Y'
]);

foreach( $query->exec()->fetchAll() as $item )
{
	$iblockName         = $item['NAME'];
	$iblockDescription  = $item['DESCRIPTION'];
}
/** **********************************************************************
 *********************** offers iblock props query ***********************
 ************************************************************************/
if( $offersIblockId > 0 )
{
	$query = new Query(PropertyTable::getEntity());
	$query->setSelect(['ID']);
	$query->setFilter
	([
		'IBLOCK_ID' => $offersIblockId,
		'!ID'       => $skuPropertyId,
	    'ACTIVE'    => 'Y'
	]);

	foreach( $query->exec()->fetchAll() as $item )
		$offersIblockProps[] = $item['ID'];
}
/** **********************************************************************
 *************************** page type catalog ***************************
 ************************************************************************/
if( $urlVariable == str_replace('/', '', $arResult['URL_TEMPLATES']['sections']) )
	$pageType = 'catalog';
/** **********************************************************************
 *************************** page type section ***************************
 ************************************************************************/
if( strlen($pageType) <= 0 && ( $useSectionCodeUrl || $useSectionIdUrl ) )
{
	$filter =
	[
		'IBLOCK_ID' => $iblockId,
	    'ACTIVE'    => 'Y'
	];
	    if( $useSectionCodeUrl )    $filter['CODE'] = $urlVariable;
	elseif( $useSectionIdUrl )      $filter['ID']   = (int) $urlVariable;

	$query = new Query(SectionTable::getEntity());
	$query->setSelect
	([
		'ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID', 'DESCRIPTION',
		'LEFT_MARGIN', 'RIGHT_MARGIN', 'DEPTH_LEVEL'
	]);
	$query->setFilter($filter);

	foreach( $query->exec()->fetchAll() as $item )
	{
		$currentSectionId           = (int) $item['ID'];
		$currentSectionCode         = $item['CODE'];
		$currentSectionName         = $item['NAME'];
		$currentSectionParent       = (int) $item['IBLOCK_SECTION_ID'];
		$currentSectionDescription  = $item['DESCRIPTION'];
		$currentSectionDepthParams  =
		[
			'LEFT_MARGIN'   => $item['LEFT_MARGIN'],
			'RIGHT_MARGIN'  => $item['RIGHT_MARGIN'],
			'DEPTH_LEVEL'   => $item['DEPTH_LEVEL']
		];
		$pageType                   = 'section';
	}
}
/** **********************************************************************
 ***************************** page type item ****************************
 ************************************************************************/
if( strlen($pageType) <= 0 && $offersIblockId > 0 && ( $useItemCodeUrl || $useItemIdUrl ) )
{
	$filter =
	[
		'IBLOCK_ID' => $offersIblockId,
		'ACTIVE'    => 'Y'
	];
	    if( $useItemCodeUrl )   $filter['CODE'] = $urlVariable;
	elseif( $useItemIdUrl )     $filter['ID']   = (int) $urlVariable;

	$query = new Query(ElementTable::getEntity());
	$query->setSelect(['ID', 'CODE', 'NAME']);
	$query->setFilter($filter);

	foreach( $query->exec()->fetchAll() as $item )
	{
		$currentOfferId     = (int) $item['ID'];
		$currentOfferCode   = $item['CODE'];
		$currentOfferName   = $item['NAME'];
		$pageType           = 'item';
	}
}
/** **********************************************************************
 *************************** smart filter path ***************************
 ************************************************************************/
if( strlen($arParams['SEF_URL_TEMPLATES']['smart_filter']) > 0 )
{
	$urlExplode             = explode('/', $uri->getPath());
	$smartFilterUrlExplode  = explode('/', $arParams['SEF_URL_TEMPLATES']['smart_filter']);

	if
	(
		count($urlExplode)              > 0 &&
		count($smartFilterUrlExplode)   > 0 &&
		count($urlExplode) >= count($smartFilterUrlExplode)
	)
	{
		while( count($smartFilterUrlExplode) > 0 )
		{
			if( array_shift($smartFilterUrlExplode) == '#SMART_FILTER_PATH#' )
				break;
			array_shift($urlExplode);
		}
		while( count($smartFilterUrlExplode) > 0 )
		{
			array_pop($smartFilterUrlExplode);
			array_pop($urlExplode);
		}

		if( count($urlExplode) > 0 )
			$smartFilterUrlValue = implode('/', $urlExplode);
	}
}
/** **********************************************************************
 *********************** section subsections query ***********************
 ************************************************************************/
if( $currentSectionId > 0 )
{
	$query = new Query(SectionTable::getEntity());
	$query->setSelect(['ID']);
	$query->setFilter
	([
		'IBLOCK_ID'     => $iblockId,
		'>LEFT_MARGIN'  => $currentSectionDepthParams['LEFT_MARGIN'],
		'<RIGHT_MARGIN' => $currentSectionDepthParams['RIGHT_MARGIN'],
		'>DEPTH_LEVEL'  => $currentSectionDepthParams['DEPTH_LEVEL']
	]);

	foreach( $query->exec()->fetchAll() as $item )
		$currentSectionSubsections[] = (int) $item['ID'];
}
/** **********************************************************************
 ************************** section offers query *************************
 ************************************************************************/
if( count($currentSectionSubsections) > 0 )
{
	$itemsId    = [];
	$query      = new Query(SectionElementTable::getEntity());

	$query->setSelect(['IBLOCK_ELEMENT_ID']);
	$query->setFilter(['IBLOCK_SECTION_ID' => array_merge($currentSectionSubsections, [$currentSectionId])]);

	foreach( $query->exec()->fetchAll() as $item )
		$itemsId[] = (int) $item['IBLOCK_ELEMENT_ID'];

	if( count($itemsId) > 0 )
	{
		$query = new Query(ElementTable::getEntity());
		$query->setSelect(['ID']);
		$query->setFilter
		([
			'ID'        => $itemsId,
			'ACTIVE'    => 'Y'
		]);

		foreach( $query->exec()->fetchAll() as $item )
			$currentSectionItems[] = (int) $item['ID'];
	}

	if( count($currentSectionItems) > 0 )
	{
		$queryList = CCatalogSKU::getOffersList($currentSectionItems);

		if( is_array($queryList) && count($queryList) > 0 )
			foreach( $queryList as $offersArray )
				foreach( $offersArray as $offer )
					$currentSectionOffers[] = (int) $offer['ID'];
	}

	$GLOBALS[$sectionFilterName] = ['ID' => count($currentSectionOffers) > 0 ? $currentSectionOffers : 'NONE'];
}
/** **********************************************************************
 *************************** offer parent item ***************************
 ************************************************************************/
if( $currentOfferId > 0 )
{
	$parentItemQuery    = CCatalogSku::GetProductInfo($currentOfferId);
	$parentItemId       = is_array($parentItemQuery) ? (int) $parentItemQuery['ID'] : 0;

	if( $parentItemId > 0 )
	{
		$query = new Query(ElementTable::getEntity());
		$query->setSelect(['ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID']);
		$query->setFilter
		([
			'ID'        => $parentItemId,
		    'ACTIVE'    => 'Y'
		]);

		foreach( $query->exec()->fetchAll() as $item )
		{
			$currentItemId          = (int) $item['ID'];
			$currentItemCode        = $item['CODE'];
			$currentItemName        = $item['NAME'];
			$currentItemSectionId   = (int) $item['IBLOCK_SECTION_ID'];
		}
	}
}
/** **********************************************************************
 ***************************** sections chain ****************************
 ************************************************************************/
if( $currentSectionParent > 0 || $currentItemSectionId > 0 )
{
	$parentSection      = $currentSectionParent > 0 ? $currentSectionParent : $currentItemSectionId;
	$iblockRootReached  = false;

	while( !$iblockRootReached )
	{
		$iblockRootReached = true;

		$query = new Query(SectionTable::getEntity());
		$query->setSelect(['ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID']);
		$query->setFilter
		([
			'ID'        => $parentSection,
			'ACTIVE'    => 'Y'
		]);

		foreach( $query->exec()->fetchAll() as $item )
		{
			array_unshift
			(
				$sectionsChain,
				[
					'ID'    => (int) $item['ID'],
					'CODE'  => $item['CODE'],
					'NAME'  => $item['NAME']
				]
			);

			$iblockSectionId = (int) $item['IBLOCK_SECTION_ID'];
			if( $iblockSectionId > 0 )
			{
				$iblockRootReached = false;
				$parentSection = $iblockSectionId;
			}
		}
	}
}
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult['IBLOCK_NAME']        = $iblockName;
$arResult['IBLOCK_DESCRIPTION'] = $iblockDescription;

$arResult['OFFERS_IBLOCK_TYPE']     = $offersIblockType;
$arResult['OFFERS_IBLOCK_ID']       = $offersIblockId;
$arResult['OFFERS_IBLOCK_PROPS']    = $offersIblockProps;

$arResult['VARIABLES']['SECTION_ID']            = $currentSectionId;
$arResult['VARIABLES']['SECTION_CODE']          = $currentSectionCode;
$arResult['VARIABLES']['SECTION_NAME']          = $currentSectionName;
$arResult['VARIABLES']['SECTION_DESCRIPTION']   = $currentSectionDescription;

$arResult['VARIABLES']['OFFER_ID']      = $currentOfferId;
$arResult['VARIABLES']['OFFER_CODE']    = $currentOfferCode;
$arResult['VARIABLES']['OFFER_NAME']    = $currentOfferName;

$arResult['VARIABLES']['ELEMENT_ID']    = $currentItemId;
$arResult['VARIABLES']['ELEMENT_CODE']  = $currentItemCode;
$arResult['VARIABLES']['ELEMENT_NAME']  = $currentItemName;

$arResult['VARIABLES']['SMART_FILTER_PATH'] = $smartFilterUrlValue;

$arResult['SECTION_FILTER_NAME']    = $sectionFilterName;
$arResult['PAGE_TYPE']              = $pageType;
$arResult['SECTIONS_CHAIN']         = $sectionsChain;