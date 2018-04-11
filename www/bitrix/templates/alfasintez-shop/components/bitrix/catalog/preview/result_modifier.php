<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use
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
$iblockType             = $arParams['IBLOCK_TYPE'];
$iblockId               = (int) $arParams['IBLOCK_ID'];
$offersIblockType       = '';
$offersIblockId         = 0;
$skuPropertyId          = 0;
$offersIblockProps      = [];
$rootSections           = [];
$sectionsSubsections    = [];
$itemsSections          = [];
$itemsOffers            = [];

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
		$offersIblockProps[] = (int) $item['ID'];
}
/** **********************************************************************
 ************************** root sections query **************************
 ************************************************************************/
$query = new Query(SectionTable::getEntity());
$query->setSelect(['ID', 'CODE', 'NAME', 'PICTURE', 'LEFT_MARGIN', 'RIGHT_MARGIN', 'DEPTH_LEVEL']);
$query->setOrder(['SORT' => 'ASC']);
$query->setFilter
([
	'IBLOCK_ID'         => $iblockId,
    'IBLOCK_SECTION_ID' => 0,
    'ACTIVE'            => 'Y'
]);

foreach( $query->exec()->fetchAll() as $item )
{
	$pictureUrl     = CFile::GetPath($item['PICTURE']);
	$sectionLink    = str_replace
	(
		['#SECTION_ID#', '#SECTION_CODE#'],
		[$item['ID'], $item['CODE']],
		$arResult['URL_TEMPLATES']['section']
	);

	$rootSections[] =
	[
		'ID'            => (int) $item['ID'],
		'CODE'          => $item['CODE'],
		'NAME'          => $item['NAME'],
		'PICTURE'       => is_string($pictureUrl) ? $pictureUrl : '',
		'LEFT_MARGIN'   => $item['LEFT_MARGIN'],
		'RIGHT_MARGIN'  => $item['RIGHT_MARGIN'],
		'DEPTH_LEVEL'   => $item['DEPTH_LEVEL'],
	    'LINK'          => $arResult['FOLDER'].$sectionLink,
	    'OFFERS'        => []
	];
}
/** **********************************************************************
 *********************** sections subsections query **********************
 ************************************************************************/
if( count($rootSections) > 0 )
	foreach( $rootSections as $section )
	{
		$query = new Query(SectionTable::getEntity());
		$query->setSelect(['ID']);
		$query->setFilter
		([
			'IBLOCK_ID'     => $iblockId,
			'>LEFT_MARGIN'  => $section['LEFT_MARGIN'],
			'<RIGHT_MARGIN' => $section['RIGHT_MARGIN'],
			'>DEPTH_LEVEL'  => $section['DEPTH_LEVEL'],
		    'ACTIVE'        => 'Y'
		]);

		foreach( $query->exec()->fetchAll() as $item )
			$sectionsSubsections[$item['ID']] = (int) $section['ID'];
	}
/** **********************************************************************
 ************************** sections items query *************************
 ************************************************************************/
if( count($rootSections) > 0 )
{
	$sections = [];
	foreach( $rootSections as $item )
		$sections[] = $item['ID'];

	if( count($sectionsSubsections) > 0 )
		$sections = array_merge($sections, array_keys($sectionsSubsections));

	$query = new Query(SectionElementTable::getEntity());
	$query->setSelect(['IBLOCK_ELEMENT_ID', 'IBLOCK_SECTION_ID']);
	$query->setFilter(['IBLOCK_SECTION_ID' => $sections]);

	foreach( $query->exec()->fetchAll() as $item )
	{
		if( !array_key_exists($item['IBLOCK_ELEMENT_ID'], $itemsSections) )
			$itemsSections[$item['IBLOCK_ELEMENT_ID']] = [];

		$itemsSections[$item['IBLOCK_ELEMENT_ID']][] = (int) $item['IBLOCK_SECTION_ID'];
	}

	if( count($itemsSections) > 0 )
	{
		$query = new Query(ElementTable::getEntity());
		$query->setSelect(['ID']);
		$query->setFilter
		([
			'ID'        => array_values($itemsSections),
			'ACTIVE'    => 'N'
		]);

		foreach( $query->exec()->fetchAll() as $item )
			unset($itemsSections[$item['ID']]);
	}
}
/** **********************************************************************
 *************************** items offers query **************************
 ************************************************************************/
if( count($itemsSections) > 0 )
{
	$queryList = CCatalogSKU::getOffersList(array_keys($itemsSections));

	if( is_array($queryList) && count($queryList) > 0 )
		foreach( $queryList as $itemId => $offersArray )
			foreach( $offersArray as $offer )
				$itemsOffers[$offer['ID']] = (int) $itemId;
}
/** **********************************************************************
 ************************** sections offers fill *************************
 ************************************************************************/
if( count($rootSections) > 0 && count($itemsOffers) > 0 )
	foreach( $rootSections as $index => $section )
	{
		$sections   = array_merge([$section['ID']], array_keys($sectionsSubsections, $section['ID']));
		$items      = [];
		$offers     = [];

		foreach( $itemsSections as $itemId => $sectionsArray )
			foreach( $sectionsArray as $sectionId )
				if( in_array($sectionId, $sections) )
				{
					$items[] = $itemId;
					break;
				}

		foreach( $items as $itemId )
			$offers = array_merge($offers, array_keys($itemsOffers, $itemId));

		$rootSections[$index]['OFFERS'] = $offers;
	}
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult['OFFERS_IBLOCK_TYPE']     = $offersIblockType;
$arResult['OFFERS_IBLOCK_ID']       = $offersIblockId;
$arResult['OFFERS_IBLOCK_PROPS']    = $offersIblockProps;
$arResult['ROOT_SECTIONS']          = $rootSections;