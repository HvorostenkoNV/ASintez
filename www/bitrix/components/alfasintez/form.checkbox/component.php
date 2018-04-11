<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* params ********************************
 ************************************************************************/
$arResult['NAME']       = $arParams['NAME'];
$arResult['VALUE']      = $arParams['VALUE'];
$arResult['TITLE']      = html_entity_decode($arParams['TITLE']);
$arResult['REQUIRED']   = $arParams['REQUIRED'] == 'Y';
$arResult['CHECKED']    = $arParams['CHECKED']  == 'Y';

$arResult['ATTR'] = '';
if( is_array($arParams['ATTR']) )
{
	$attrArray = [];
	foreach( $arParams['ATTR'] as $index => $value )
		$attrArray[] = $index.'="'.str_replace(['"', '\''], '', $value).'"';
	$arResult['ATTR'] = implode(' ', $attrArray);
}
/** **********************************************************************
 ********************************* output ********************************
 ************************************************************************/
$this->IncludeComponentTemplate();