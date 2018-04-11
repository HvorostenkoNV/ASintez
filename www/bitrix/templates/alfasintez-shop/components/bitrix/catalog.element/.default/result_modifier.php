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
	Bitrix\Iblock\SectionTable,
	Bitrix\Iblock\SectionElementTable,
	Bitrix\Iblock\PropertyTable,
	Av\ImageProcessing\Watermarks\WatermarkAdding;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loader::includeModule('iblock');
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$context                = Application::getInstance()->getContext();
$server                 = $context->getServer();
$request                = $context->getRequest();
$uri                    = new Uri($request->getRequestUri());

$iblockId               = (int) $arParams['IBLOCK_ID'];
$iblockType             = $arParams['IBLOCK_TYPE'];
$offersIblockId         = count($arResult['OFFERS']) > 0 ? (int) $arResult['OFFERS'][0]['IBLOCK_ID'] : 0;
$itemId                 = (int) $arParams['ELEMENT_ID'];
$altPicturePropertyCode = $arParams['PICTURES_ALT'];
$itemSections           = [];
$offersProperties       = [];
$itemPictures           = [];

if( $iblockId <= 0 || $itemId <= 0 || strlen($iblockType) <= 0 ) return;
/** **********************************************************************
 ************************** item sections query **************************
 ************************************************************************/
$activeSections = [];

$query = new Query(SectionElementTable::getEntity());
$query->setSelect(['IBLOCK_SECTION_ID']);
$query->setFilter(['IBLOCK_ELEMENT_ID' => $itemId]);

foreach( $query->exec()->fetchAll() as $item )
	$itemSections[] = (int) $item['IBLOCK_SECTION_ID'];

if( count($itemSections) > 0 )
{
	$query = new Query(SectionTable::getEntity());
	$query->setSelect(['ID']);
	$query->setFilter(['ID' => array_values($itemSections), 'ACTIVE' => 'Y']);

	foreach( $query->exec()->fetchAll() as $item )
		$activeSections[] = (int) $item['ID'];
}

foreach( $itemSections as $index => $sectionId )
	if( !in_array($sectionId, $activeSections) )
		unset($itemSections[$sectionId]);
/** **********************************************************************
 *********************** sections properties query ***********************
 ************************************************************************/
if( count($itemSections) > 0 && $offersIblockId > 0 )
	foreach( $itemSections as $sectionId )
	{
		$properties = CIBlockSectionPropertyLink::GetArray($offersIblockId, $sectionId);

		if( is_array($properties) )
			foreach( $properties as $item )
				$offersProperties[] = (int) $item['PROPERTY_ID'];
	}
/** **********************************************************************
 ******************************** images *********************************
 ************************************************************************/
if( is_array($arResult['DETAIL_PICTURE']) && count($arResult['DETAIL_PICTURE']) > 0 )
	$itemPictures[] = $arResult['DETAIL_PICTURE'];

if( strlen($altPicturePropertyCode) > 0 )
{
	$query = new Query(PropertyTable::getEntity());
	$query->setSelect(['CODE']);
	$query->setFilter
	([
		'IBLOCK_ID'     => $iblockId,
		'CODE'          => $altPicturePropertyCode,
		'PROPERTY_TYPE' => 'F',
		'ACTIVE'        => 'Y'
	]);

	foreach( $query->exec()->fetchAll() as $item )
		if
		(
			array_key_exists($item['CODE'], $arResult['PROPERTIES'])    &&
			is_array($arResult['PROPERTIES'][$item['CODE']])            &&
			count($arResult['PROPERTIES'][$item['CODE']]) > 0
		)
		{
			$propertyInfo   = $arResult['PROPERTIES'][$item['CODE']];
			$propertyValue  = array_key_exists('VALUE', $propertyInfo) && is_array($propertyInfo['VALUE'])
				? $propertyInfo['VALUE']
				: [];

			foreach( $propertyValue as $value )
			{
				$fileId     = (int) $value;
				$fileInfo   = $fileId > 0 ? CFile::GetFileArray($fileId) : [];

				if( is_array($fileInfo) && count($fileInfo) > 0 )
					$itemPictures[] = $fileInfo;
			}
		}
}
/** **********************************************************************
 ****************************** watermarks *******************************
 ************************************************************************/
if( count($itemPictures) > 0 )
	foreach( $itemPictures as $index => $item )
	{
		try
		{
			$imageUrl               = array_key_exists('UNSAFE_SRC', $item) ? $item['UNSAFE_SRC'] : $item['SRC'];
			$imageWithWatermarkUrl  = (new WatermarkAdding($imageUrl))->getImageProcessedUrl();

			if( strlen($imageWithWatermarkUrl) > 0 )
				$itemPictures[$index]['SRC'] = $imageWithWatermarkUrl;
		}
		catch( Exception $exception )
		{

		};
	}
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$resultUsedKeys =
[
	'CAT_PRICES', 'PRICES',
	'ID', 'IBLOCK_ID', 'CODE', 'NAME', 'ACTIVE', 'IBLOCK_SECTION_ID',
	'PREVIEW_TEXT', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PREVIEW_PICTURE',
	'IBLOCK_TYPE_ID', 'IBLOCK_CODE',
	'PROPERTIES', 'OFFERS', 'SECTION'
];
$offersUsedKeys =
[
	'ID', 'IBLOCK_ID', 'NAME',
	'PREVIEW_PICTURE', 'DETAIL_PICTURE',
	'PRICES', 'PROPERTIES', 'ITEM_MEASURE'
];

$arResult = array_intersect_key($arResult, array_flip($resultUsedKeys));

foreach( $arResult['OFFERS'] as $index => $value )
{
	$value                  = array_intersect_key($value,               array_flip($offersUsedKeys));
	$value['PROPERTIES']    = array_intersect_key($value['PROPERTIES'], array_flip($offersProperties));

	$arResult['OFFERS'][$index] = $value;
}

$arResult['ASK_FORM_ID']        = (int) $arParams['ASK_FORM_ID'];
$arResult['IMAGES']             = $itemPictures;
$arResult['ITEM_ADMIN_LINK']    = $uri->getScheme().'://'.$server->getServerName().'/bitrix/admin/iblock_element_edit.php?IBLOCK_ID='.$iblockId.'&type='.$iblockType.'&ID='.$itemId;