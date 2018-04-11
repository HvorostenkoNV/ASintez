<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use
	Bitrix\Main\Loader,
	Bitrix\Main\Entity\Query,
	Bitrix\Iblock\ElementTable,
	Bitrix\Iblock\SectionTable,
	Bitrix\Iblock\SectionElementTable;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loader::includeModule('iblock');
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$iblockId           = (int) $arParams['IBLOCK_ID'];
$catalogIblockId    = (int) $arParams['CATALOG_IBLOCK_ID'];
$offersProducts     = [];
$sectionsProducts   = [];
$sectionsProperties = [];

if( $iblockId <= 0 || $catalogIblockId <= 0 ) return;

if( count($arResult['ITEMS']) > 0)
	foreach( $arResult['ITEMS'] as $item )
		$offersProducts[$item['ID']] = 0;
/** **********************************************************************
 **************************** products query *****************************
 ************************************************************************/
if( count($offersProducts) > 0 )
{
	$queryList = CCatalogSKU::getProductList(array_keys($offersProducts), $iblockId);
	if( is_array($queryList) )
		foreach( $queryList as $offerId => $item )
			$offersProducts[$offerId] = (int) $item['ID'];

	$query = new Query(ElementTable::getEntity());
	$query->setSelect(['ID']);
	$query->setFilter
	([
		'ID'        => array_values($offersProducts),
		'ACTIVE'    => 'N'
	]);

	foreach( $query->exec()->fetchAll() as $item )
		unset($offersProducts[array_search($item['ID'], $offersProducts)]);
}
/** **********************************************************************
 **************************** sections query *****************************
 ************************************************************************/
if( count($offersProducts) > 0 )
{
	$query = new Query(SectionElementTable::getEntity());
	$query->setSelect(['IBLOCK_ELEMENT_ID', 'IBLOCK_SECTION_ID']);
	$query->setFilter(['IBLOCK_ELEMENT_ID' => array_values($offersProducts)]);

	foreach( $query->exec()->fetchAll() as $item )
		$sectionsProducts[$item['IBLOCK_SECTION_ID']] = (int) $item['IBLOCK_ELEMENT_ID'];

	if( count($sectionsProducts) > 0 )
	{
		$query = new Query(SectionTable::getEntity());
		$query->setSelect(['ID']);
		$query->setFilter
		([
			'ID'        => array_keys($sectionsProducts),
			'ACTIVE'    => 'N'
		]);

		foreach( $query->exec()->fetchAll() as $item )
			unset($sectionsProducts[$item['ID']]);
	}
}
/** **********************************************************************
 *********************** sections properties query ***********************
 ************************************************************************/
if( count($sectionsProducts) > 0 )
	foreach( array_unique(array_keys($sectionsProducts)) as $sectionId )
	{
		$sectionsProperties[$sectionId] = [];
		$properties                     = CIBlockSectionPropertyLink::GetArray($iblockId, $sectionId);

		if( is_array($properties) )
			foreach( $properties as $item )
				$sectionsProperties[$sectionId][] = (int) $item['PROPERTY_ID'];
	}
/** **********************************************************************
 ******************** remove non used items properties *******************
 ************************************************************************/
if( count($arResult['ITEMS']) > 0)
	foreach( $arResult['ITEMS'] as $index => $item )
	{
		$productId          = $offersProducts[$item['ID']];
		$sectionsId         = array_keys($sectionsProducts, $productId);
		$currentProperties  = array_keys($item['DISPLAY_PROPERTIES']);
		$allowedProperties  = [];
		$propertiesToRemove = [];

		foreach( $sectionsId as $sectionId )
			$allowedProperties = array_merge($allowedProperties, $sectionsProperties[$sectionId]);

		$propertiesToRemove = array_diff($currentProperties, $allowedProperties);

		if( count($propertiesToRemove) > 0 )
			foreach( $propertiesToRemove as $propertyId )
				unset($arResult['ITEMS'][$index]['DISPLAY_PROPERTIES'][$propertyId]);
	}