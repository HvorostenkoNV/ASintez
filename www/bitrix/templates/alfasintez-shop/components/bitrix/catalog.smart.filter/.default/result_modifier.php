<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use
	Bitrix\Main\Entity\Query,
	Bitrix\Iblock\SectionTable;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$iblockId       = (int) $arParams['IBLOCK_ID'];
$sectionId      = (int) $arParams['SECTION_ID'];
$sectionCode    = $arParams['SECTION_CODE'];
$filterName     = strlen($arParams['FILTER_NAME']) > 0 ? $arParams['FILTER_NAME'] : 'arrFilter';
$properties     = $arResult['ITEMS'];
if( $iblockId <= 0 ) return;
/** **********************************************************************
 **************************** section ID/CODE ****************************
 ************************************************************************/
if
(
	($sectionId > 0 || strlen($sectionCode) > 0) &&
	($sectionId <= 0 || strlen($sectionCode) <= 0)
)
{
	$filter = ['IBLOCK_ID' => $iblockId];
	if( $sectionId > 0 )    $filter['ID']   = (int) $sectionId;
	else                    $filter['CODE'] = $sectionCode;

	$query = new Query(SectionTable::getEntity());
	$query->setSelect(['ID', 'CODE']);
	$query->setFilter($filter);

	foreach( $query->exec()->fetchAll() as $item )
	{
		$sectionId      = (int) $item['ID'];
		$sectionCode    =       $item['CODE'];
	}
}
/** **********************************************************************
 ************************ properties refactoring *************************
 ************************************************************************/
unset($properties['BASE']);

if( count($properties) > 0 )
	foreach( $properties as $index => $item )
	{
		$applied    = false;
		$inputName  = '';

		if( count($item['VALUES']) <= 0 )
		{
			unset($properties[$index]);
			continue;
		}

		foreach( $item['VALUES'] as $listItemIndex => $listItem )
		{
			$checked = array_key_exists('CHECKED', $listItem);

			if( $checked )                  $applied = true;
			if( strlen($inputName) <= 0 )   $inputName = $listItem['CONTROL_NAME_ALT'];

			$properties[$index]['VALUES'][$listItemIndex]['CHECKED'] = $checked;
		}

		$properties[$index]['APPLIED']      = $applied;
		$properties[$index]['INPUT_NAME']   = $inputName;
	}
/** **********************************************************************
 ***************************** filter applied ****************************
 ************************************************************************/
if
(
	array_key_exists($filterName, $GLOBALS)            &&
	is_array($GLOBALS[$filterName])                    &&
	array_key_exists('OFFERS', $GLOBALS[$filterName])  &&
	is_array($GLOBALS[$filterName]['OFFERS'])
)
	foreach( $GLOBALS[$filterName]['OFFERS'] as $index => $value )
		$GLOBALS[$filterName][$index] = $value;
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult['ITEMS']                          = $properties;
$arResult['SECTION_ID']                     = $sectionId;
$arResult['SECTION_CODE']                   = $sectionCode;
$arResult['APPLIED_FILTER_URL_TEMPLATE']    = str_replace(['#SECTION_ID#', '#SECTION_CODE#'], [$sectionId, $sectionCode], $arParams['SEF_RULE']);
$arResult['FILTER_NAME']                    = $filterName;