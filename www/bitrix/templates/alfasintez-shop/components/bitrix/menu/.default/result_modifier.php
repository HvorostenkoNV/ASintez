<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
foreach( $arResult as $index => $itemInfo )
	if( intval($itemInfo['DEPTH_LEVEL']) > 1 )
		unset($arResult[$index]);

$arResult = array_values($arResult);