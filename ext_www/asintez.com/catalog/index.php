<?
/** **********************************************************************
 * @var CMain $APPLICATION
 ************************************************************************/
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle       ('Упаковка для продуктов питания');
$APPLICATION->SetPageProperty('title',       '');
$APPLICATION->SetPageProperty('description', '');
/** **********************************************************************
 ********************************* page **********************************
 ************************************************************************/
$APPLICATION->IncludeComponent
(
	'bitrix:catalog', '',
	array(
		'IBLOCK_TYPE'               => 'catalog_asintez',
		'IBLOCK_ID'                 => 8,
		'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',

		'SEF_MODE'          => 'Y',
		'SEF_FOLDER'        => '',
		'SEF_URL_TEMPLATES' =>
		array(
			'sections'      => '/catalog/',
			'section'       => '/#SECTION_CODE#/',
			'element'       => '/#ELEMENT_CODE#/',
			'compare'       => '',
			'smart_filter'  => '/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/'
		),

		'CACHE_TYPE'    => 'A',
		'CACHE_TIME'    => 36000000,
		'CACHE_FILTER'  => 'Y',
		'CACHE_GROUPS'  => 'Y',

		'USE_FILTER'    => 'Y',
		'FILTER_NAME'   => '',

		'PRICE_CODE'        => array('BASE'),
		'PRICE_VAT_INCLUDE' => 'Y',
		'CONVERT_CURRENCY'  => 'Y',
		'CURRENCY_ID'       => 'UAH',

		'INCLUDE_SUBSECTIONS'       => 'Y',
		'LIST_OFFERS_FIELD_CODE'    => array('NAME', 'PREVIEW_PICTURE'),
		'PAGE_ELEMENT_COUNT'        => 16,

		'DETAIL_SET_CANONICAL_URL'  => 'N',
		'DETAIL_OFFERS_FIELD_CODE'  => array('NAME'),
		'DETAIL_PICTURES_ALT'       => 'MORE_PHOTO',
		'ASK_FORM_ID'               => 5,
		'ASK_FORM_LINK_FIELD_ID'    => 'form_text_12',

		'OFFERS_SORT_FIELD'     => 'sort',
		'OFFERS_SORT_ORDER'     => 'asc',
		'OFFERS_SORT_FIELD2'    => 'id',
		'OFFERS_SORT_ORDER2'    => 'desc',

		'PAGER_TEMPLATE'       => '',
		'DISPLAY_TOP_PAGER'    => 'N',
		'DISPLAY_BOTTOM_PAGER' => 'Y',

		'SET_TITLE'             => 'Y',
		'ADD_SECTIONS_CHAIN'    => 'Y',
		'ADD_ELEMENT_CHAIN'     => 'Y',
		'USE_ELEMENT_COUNTER'   => 'Y',
		'CHAIN_TITLE'           => 'Каталог'
	)
);

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php';