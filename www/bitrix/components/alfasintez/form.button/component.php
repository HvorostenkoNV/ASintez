<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* params ********************************
 ************************************************************************/
$arResult['NAME']           = $arParams['NAME'];
$arResult['VALUE']          = $arParams['VALUE'];
$arResult['TITLE']          = html_entity_decode($arParams['TITLE']);
$arResult['PLACEHOLDER']    = html_entity_decode($arParams['PLACEHOLDER']);

$arResult['BUTTON_TYPE']    = in_array($arParams['BUTTON_TYPE'], ['button', 'submit', 'link', 'label']) ? $arParams['BUTTON_TYPE']                   : 'button';
$arResult['LINK']           = $arParams['BUTTON_TYPE'] == 'link'                                        ? htmlspecialchars_decode($arParams['LINK']) : '';

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