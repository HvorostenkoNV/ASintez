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
	'NAME'   => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PARAMS_HIDE_NOT_AVAILABLE_OFFERS'),
	'TYPE'   => 'CHECKBOX',
	'PARENT' => 'BASE'
];
$arTemplateParameters['USE_ELEMENT_COUNTER'] =
[
	'NAME' => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_USE_ELEMENT_COUNTER'),
	'TYPE' => 'CHECKBOX'
];
/** **********************************************************************
 **************************** params to hide *****************************
 ************************************************************************/
$paramsToHide =
[
	'SHOW_DEACTIVATED',             'OFFERS_LIMIT',                     'BACKGROUND_IMAGE',
	'SECTION_ID_VARIABLE',          'CHECK_SECTION_ID_VARIABLE',        'SET_BROWSER_TITLE',
	'BROWSER_TITLE',                'SET_META_KEYWORDS',                'META_KEYWORDS',
	'SET_META_DESCRIPTION',         'META_DESCRIPTION',                 'SET_LAST_MODIFIED',
	'ACTION_VARIABLE',              'PRODUCT_ID_VARIABLE',              'DISPLAY_COMPARE',
	'COMPARE_PATH',                 'USE_PRICE_COUNT',                  'SHOW_PRICE_COUNT',
	'PRICE_VAT_SHOW_VALUE',         'BASKET_URL',                       'USE_PRODUCT_QUANTITY',
	'ADD_PROPERTIES_TO_BASKET',     'PRODUCT_PROPS_VARIABLE',           'PARTIAL_PRODUCT_PROPERTIES',
	'PRODUCT_PROPERTIES',           'OFFERS_CART_PROPERTIES',           'LINK_IBLOCK_TYPE',
	'LINK_IBLOCK_ID',               'LINK_IBLOCK_ID',                   'LINK_PROPERTY_SID',
	'USE_GIFTS_DETAIL',             'USE_GIFTS_MAIN_PR_SECTION_LIST',   'COMPATIBLE_MODE',
	'DISABLE_INIT_JS_IN_COMPONENT', 'SET_VIEWED_IN_COMPONENT'
];

foreach( $paramsToHide as $param )
	$arTemplateParameters[$param] = ['HIDDEN' => 'Y'];
/** **********************************************************************
 ******************************* new params ******************************
 ************************************************************************/
if( count($iblockPropsFile) > 0 )
	$arTemplateParameters['PICTURES_ALT'] =
	[
		'NAME'   => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PARAMS_PICTURES_ALT'),
		'TYPE'   => 'LIST',
		'VALUES' => array_merge([0 => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PARAMS_LIST_EMPTY_VALUE')], $iblockPropsFile),
	];

$arTemplateParameters['ASK_FORM_ID'] =
[
	'NAME' => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PARAMS_ASK_FORM_ID'),
	'TYPE' => 'STRING'
];
if( $askFormId > 0 )
	$arTemplateParameters['ASK_FORM_LINK_FIELD_ID'] =
	[
		'NAME' => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PARAMS_ASK_FORM_LINK_FIELD_ID'),
		'TYPE' => 'STRING'
	];