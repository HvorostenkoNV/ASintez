<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$items = [];
/** **********************************************************************
 **************************** resort soc links ***************************
 ************************************************************************/
foreach( $arParams as $index => $value )
	if( array_key_exists($index, $arResult['SOCSERV']) )
		$items[$index] = $arResult['SOCSERV'][$index];
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult['SOCSERV'] = $items;