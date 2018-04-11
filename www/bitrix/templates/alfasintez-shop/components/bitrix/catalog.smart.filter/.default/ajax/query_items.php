<?
use
	Bitrix\Main\Loader,
	Bitrix\Main\Entity\Query,
	Bitrix\Iblock\ElementTable,
	Bitrix\Iblock\PropertyTable,
	Bitrix\Iblock\PropertyEnumerationTable;

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loader::includeModule('iblock');
Loader::includeModule('catalog');
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$iblockId               = array_key_exists('iblock-id',         $_POST) ? (int) $_POST['iblock-id']         : 0;
$offersIblockId         = array_key_exists('offers-iblock-id',  $_POST) ? (int) $_POST['offers-iblock-id']  : 0;
$sectionId              = array_key_exists('section-id',        $_POST) ? (int) $_POST['section-id']        : 0;
$filterUrlTemplate      = array_key_exists('filter-url',        $_POST) ?       $_POST['filter-url']        : '';
$filterName             = array_key_exists('filter-name',       $_POST) ?       $_POST['filter-name']       : '';
$filterValues           = [];
$properties             = [];
$sectionItems           = [];
$sectionFilteredItems   = [];
$filteredOffers         = [];
$filterUrl              = '';

if
(
	$iblockId <= 0                  ||
	$offersIblockId <= 0            ||
	strlen($filterUrlTemplate) <= 0 ||
	strlen($filterName) <= 0
)
{
	echo json_encode(['ERROR' => true]);
	return;
}
/** **********************************************************************
 ************************** geted filter values **************************
 ************************************************************************/
if( array_key_exists('values', $_POST) && is_array($_POST['values']) )
	foreach( $_POST['values'] as $index => $value )
	{
		$indexExplode   = explode('_', str_replace($filterName.'_', '', $index));
		$propertyId     = array_key_exists(0, $indexExplode) ? (int) $indexExplode[0] : 0;
		$propertyValue  = array_key_exists(1, $indexExplode) ?       $indexExplode[1] : $value;
		if( $propertyId <= 0 || strlen($propertyValue) <= 0 ) continue;

		if( !array_key_exists($propertyId, $filterValues) )
			$filterValues[$propertyId] = [];
		$filterValues[$propertyId][] = $propertyValue;
	}
/** **********************************************************************
 ************************ filter properties query ************************
 ************************************************************************/
if( count($filterValues) > 0 )
{
	$query = new Query(PropertyTable::getEntity());
	$query->setSelect(['ID', 'IBLOCK_ID', 'PROPERTY_TYPE']);
	$query->setFilter
	([
		'IBLOCK_ID' => [$iblockId, $offersIblockId],
		'ID'        => array_keys($filterValues),
		'ACTIVE'    => 'Y'
	]);

	foreach( $query->exec()->fetchAll() as $item )
		$properties[$item['ID']] = array_merge($item, ['VALUES' => []]);
}
/** **********************************************************************
 ******************** filter properties values query *********************
 ************************************************************************/
if( count($properties) > 0 )
{
	$query = new Query(PropertyEnumerationTable::getEntity());
	$query->setSelect(['ID', 'PROPERTY_ID', 'XML_ID']);
	$query->setFilter(['PROPERTY_ID' => array_keys($properties)]);

	foreach( $query->exec()->fetchAll() as $item )
	{
		$encryptedValue = abs(crc32($item['ID']));
		$properties[$item['PROPERTY_ID']]['VALUES'][$encryptedValue] = $item;
	}
}
/** **********************************************************************
 ********************* geted filter values decoding **********************
 ************************************************************************/
if( count($filterValues) > 0 )
	foreach( $filterValues as $propertyId => $values )
		foreach( $values as $index => $value )
		{
			if
			(
				array_key_exists($propertyId,   $properties) &&
				array_key_exists($value,        $properties[$propertyId]['VALUES'])
			)
				$filterValues[$propertyId][$index] = $properties[$propertyId]['VALUES'][$value]['ID'];
			else
				unset($filterValues[$propertyId][$index]);
		}
/** **********************************************************************
 ************************* catalog section items *************************
 ************************************************************************/
if( $sectionId > 0 )
{
	$query = new Query(ElementTable::getEntity());
	$query->setSelect(['ID']);
	$query->setFilter
	([
		'IBLOCK_ID'         => $iblockId,
		'IBLOCK_SECTION_ID' => $sectionId
	]);

	foreach( $query->exec()->fetchAll() as $item )
		$sectionItems[] = (int) $item['ID'];
}
/** **********************************************************************
 ******************** catalog section filtered items *********************
 ************************************************************************/
$filter = ['IBLOCK_ID' => $iblockId];

if( count($sectionItems) > 0 )
	$filter['ID'] = $sectionItems;

foreach( $properties as $item )
	if( $item['IBLOCK_ID'] == $iblockId && count($filterValues[$item['ID']]) > 0 )
		$filter['PROPERTY_'.$item['ID']] = $filterValues[$item['ID']];

$queryList = CIBlockElement::GetList([], $filter, false, false, ['ID']);
while( $queryItem = $queryList->GetNext() )
	$sectionFilteredItems[] = (int) $queryItem['ID'];
/** **********************************************************************
 **************************** filtered offers ****************************
 ************************************************************************/
$filter = ['IBLOCK_ID' => $offersIblockId];

foreach( $properties as $item )
	if( $item['IBLOCK_ID'] == $offersIblockId && count($filterValues[$item['ID']]) > 0 )
		$filter['PROPERTY_'.$item['ID']] = $filterValues[$item['ID']];

$queryList = CCatalogSKU::getOffersList($sectionItems, $iblockId, $filter);

if( is_array($queryList) && count($queryList) > 0 )
	foreach( $queryList as $offersArray )
		foreach( $offersArray as $offer )
			$filteredOffers[] = (int) $offer['ID'];
/** **********************************************************************
 ******************************* filter url ******************************
 ************************************************************************/
$filterParts = [];

foreach( $filterValues as $propertyId => $values )
{
	$filterPropertyParts = [];

	foreach( $values as $value )
		foreach( $properties[$propertyId]['VALUES'] as $valueInfo )
			if( $valueInfo['ID'] == $value )
			{
				$filterPropertyParts[] = $valueInfo['XML_ID'];
				break;
			}

	$filterParts[] = $propertyId.'-is-'.implode('-or-', $filterPropertyParts);
}

$filterUrl = count($filterParts) > 0
	? str_replace('#SMART_FILTER_PATH#', implode('/', $filterParts), $filterUrlTemplate)
	: '';
/** **********************************************************************
 ******************************** output *********************************
 ************************************************************************/
echo json_encode
([
	'ITEMS'     => $sectionFilteredItems,
	'OFFERS'    => $filteredOffers,
	'URL'       => $filterUrl
]);