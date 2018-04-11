<?
/** **********************************************************************
 * @var array $arCurrentValues
 ************************************************************************/
use
	Bitrix\Main\Loader,
	Bitrix\Main\Entity\Query,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock\PropertyTable;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loader::includeModule('iblock');
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$iblockId           = (int) $arCurrentValues['IBLOCK_ID'];
$askFormId          = (int) $arCurrentValues['ASK_FORM_ID'];
$iblockPropsFile    = [];

if( $iblockId > 0 )
{
	$query = new Query(PropertyTable::getEntity());
	$query->setSelect(['CODE', 'NAME']);
	$query->setFilter
	([
		'IBLOCK_ID'     => $iblockId,
		'ACTIVE'        => 'Y',
		'PROPERTY_TYPE' => 'F'
	]);

	foreach( $query->exec()->fetchAll() as $item )
		$iblockPropsFile[$item['CODE']] = $item['NAME'];
}
/** **********************************************************************
 ************************** old params refactor **************************
 ************************************************************************/
$arTemplateParameters['HIDE_NOT_AVAILABLE_OFFERS'] =
[
	'NAME'   => Loc::getMessage('ALFASINTEZ_CATALOG_PREVIEW_PARAMS_HIDE_NOT_AVAILABLE_OFFERS'),
	'TYPE'   => 'CHECKBOX',
	'PARENT' => 'BASE'
];
$arTemplateParameters['SET_TITLE'] =
[
	'NAME'   => Loc::getMessage('ALFASINTEZ_CATALOG_PREVIEW_PARAMS_SET_TITLE'),
	'TYPE'   => 'CHECKBOX',
	'PARENT' => 'EXTENDED_SETTINGS'
];
/** **********************************************************************
 **************************** params to hide *****************************
 ************************************************************************/
$paramsToHide =
[
	'HIDE_NOT_AVAILABLE',               'USE_MAIN_ELEMENT_SECTION', 'DETAIL_STRICT_SECTION_CHECK',
	'FILTER_FIELD_CODE',                'FILTER_OFFERS_FIELD_CODE', 'FILTER_PROPERTY_CODE',         'FILTER_OFFERS_PROPERTY_CODE',
	'LIST_PROPERTY_CODE',               'DETAIL_PROPERTY_CODE',     'LIST_OFFERS_PROPERTY_CODE',    'DETAIL_OFFERS_PROPERTY_CODE',
	'BASKET_URL',                       'USER_CONSENT',             'USER_CONSENT_ID',              'USER_CONSENT_IS_CHECKED',      'USER_CONSENT_IS_LOADED',
	'AJAX_MODE',                        'AJAX_OPTION_JUMP',         'AJAX_OPTION_STYLE',            'AJAX_OPTION_HISTORY',          'AJAX_OPTION_ADDITIONAL',
	'SET_LAST_MODIFIED',                'USE_REVIEW',               'ACTION_VARIABLE',              'PRODUCT_ID_VARIABLE',          'USE_COMPARE',
	'FILTER_PRICE_CODE',                'USE_PRICE_COUNT',          'SHOW_PRICE_COUNT',             'PRICE_VAT_SHOW_VALUE',
	'USE_PRODUCT_QUANTITY',             'ADD_PROPERTIES_TO_BASKET', 'PRODUCT_PROPS_VARIABLE',       'PARTIAL_PRODUCT_PROPERTIES',   'PRODUCT_PROPERTIES',       'OFFERS_CART_PROPERTIES',
	'SHOW_TOP_ELEMENTS',                'SECTION_COUNT_ELEMENTS', 'SECTION_TOP_DEPTH',
	'TOP_ELEMENT_COUNT',                'TOP_LINE_ELEMENT_COUNT', 'TOP_ELEMENT_SORT_FIELD', 'TOP_ELEMENT_SORT_ORDER', 'TOP_ELEMENT_SORT_FIELD2', 'TOP_ELEMENT_SORT_ORDER2', 'TOP_PROPERTY_CODE',
	'LINE_ELEMENT_COUNT',               'LIST_META_KEYWORDS', 'LIST_META_DESCRIPTION', 'LIST_BROWSER_TITLE', 'SECTION_BACKGROUND_IMAGE',
	'DETAIL_META_KEYWORDS',                     'DETAIL_META_DESCRIPTION', 'DETAIL_BROWSER_TITLE', 'SECTION_ID_VARIABLE', 'DETAIL_CHECK_SECTION_ID_VARIABLE', 'DETAIL_BACKGROUND_IMAGE', 'SHOW_DEACTIVATED',
	'LINK_IBLOCK_TYPE',                         'LINK_IBLOCK_ID', 'LINK_PROPERTY_SID', 'LINK_ELEMENTS_URL',
	'USE_ALSO_BUY',                             'USE_GIFTS_DETAIL', 'USE_GIFTS_SECTION', 'USE_GIFTS_MAIN_PR_SECTION_LIST',
	'GIFTS_DETAIL_PAGE_ELEMENT_COUNT',          'GIFTS_DETAIL_HIDE_BLOCK_TITLE', 'GIFTS_DETAIL_BLOCK_TITLE', 'GIFTS_DETAIL_TEXT_LABEL_GIFT',
	'GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT',    'GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE', 'GIFTS_SECTION_LIST_BLOCK_TITLE', 'GIFTS_SECTION_LIST_TEXT_LABEL_GIFT',
	'GIFTS_SHOW_DISCOUNT_PERCENT', 'GIFTS_SHOW_OLD_PRICE', 'GIFTS_SHOW_NAME', 'GIFTS_SHOW_IMAGE',
	'GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT', 'GIFTS_MESS_BTN_BUY', 'GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE', 'GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE',
	'USE_STORE', 'PAGER_TITLE', 'PAGER_SHOW_ALWAYS', 'PAGER_DESC_NUMBERING', 'PAGER_SHOW_ALL', 'PAGER_BASE_LINK_ENABLE', 'PAGER_DESC_NUMBERING_CACHE_TIME',
	'COMPATIBLE_MODE', 'DISABLE_INIT_JS_IN_COMPONENT', 'DETAIL_SET_VIEWED_IN_COMPONENT',
	'TOP_OFFERS_FIELD_CODE', 'TOP_OFFERS_PROPERTY_CODE', 'TOP_OFFERS_LIMIT', 'LIST_OFFERS_LIMIT',
	'ELEMENT_SORT_FIELD', 'ELEMENT_SORT_ORDER', 'ELEMENT_SORT_FIELD2', 'ELEMENT_SORT_ORDER2',
	'SET_STATUS_404', 'SHOW_404', 'MESSAGE_404', 'FILE_404',
	'USE_FILTER', 'FILTER_NAME', 'ADD_SECTIONS_CHAIN', 'ADD_ELEMENT_CHAIN',
	'USE_ELEMENT_COUNTER', 'DETAIL_SET_CANONICAL_URL', 'DETAIL_OFFERS_FIELD_CODE',
	'PAGER_TEMPLATE', 'DISPLAY_TOP_PAGER', 'DISPLAY_BOTTOM_PAGER',
];

foreach( $paramsToHide as $param )
	$arTemplateParameters[$param] = ['HIDDEN' => 'Y'];