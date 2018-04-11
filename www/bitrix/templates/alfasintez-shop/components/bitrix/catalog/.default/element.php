<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* page **********************************
 ************************************************************************/
$APPLICATION->IncludeComponent
(
	'bitrix:catalog.element', '',
	[
		'IBLOCK_TYPE'   => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID'     => $arParams['IBLOCK_ID'],
		'ELEMENT_ID'    => $arResult['VARIABLES']['ELEMENT_ID'],
		'ELEMENT_CODE'  => '',
		'SECTION_ID'    => '',
		'SECTION_CODE'  => '',

		'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

		'PROPERTY_CODE'         => [$arParams['DETAIL_PICTURES_ALT']],
		'OFFERS_FIELD_CODE'     => $arParams['DETAIL_OFFERS_FIELD_CODE'],
		'OFFERS_PROPERTY_CODE'  => $arResult['OFFERS_IBLOCK_PROPS'],
		'OFFERS_SORT_FIELD'     => $arParams['OFFERS_SORT_FIELD'],
		'OFFERS_SORT_ORDER'     => $arParams['OFFERS_SORT_ORDER'],
		'OFFERS_SORT_FIELD2'    => $arParams['OFFERS_SORT_FIELD2'],
		'OFFERS_SORT_ORDER2'    => $arParams['OFFERS_SORT_ORDER2'],

		'SECTION_URL'   => '',
		'DETAIL_URL'    => '',

		'CACHE_TYPE'    => $arParams['CACHE_TYPE'],
		'CACHE_TIME'    => $arParams['CACHE_TIME'],
		'CACHE_GROUPS'  => $arParams['CACHE_GROUPS'],

		'SET_TITLE'                 => 'N',
		'SET_CANONICAL_URL'         => $arParams['DETAIL_SET_CANONICAL_URL'],
		'ADD_SECTIONS_CHAIN'        => 'N',
		'ADD_ELEMENT_CHAIN'         => 'N',
		'USE_ELEMENT_COUNTER'       => $arParams['USE_ELEMENT_COUNTER'],
		'PICTURES_ALT'              => $arParams['DETAIL_PICTURES_ALT'],
		'ASK_FORM_ID'               => $arParams['ASK_FORM_ID'],
		'ASK_FORM_LINK_FIELD_ID'    => $arParams['ASK_FORM_LINK_FIELD_ID'],

		'PRICE_CODE'        => $arParams['PRICE_CODE'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'CONVERT_CURRENCY'  => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID'       => $arParams['CURRENCY_ID']
	],
	false, ['HIDE_ICONS' => 'Y']
);