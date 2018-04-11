<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 **************************** sections slider ****************************
 ************************************************************************/
?>
<?$this->SetViewTarget('catalog_sections_slider')?>
<div class="alfasintez-catalog-top-sections-cell">
	<?
	$APPLICATION->IncludeComponent
	(
		'bitrix:catalog.section.list', 'slider',
		[
			'IBLOCK_TYPE'   => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID'     => $arParams['IBLOCK_ID'],

			'SECTION_URL'   => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'TOP_DEPTH'     => 1,

			'CACHE_TYPE'    => $arParams['CACHE_TYPE'],
			'CACHE_TIME'    => $arParams['CACHE_TIME'],
			'CACHE_GROUPS'  => $arParams['CACHE_GROUPS'],

			'ADD_SECTIONS_CHAIN'    => 'N'
		],
		false, ['HIDE_ICONS' => 'Y']
	);
	?>
</div>
<?$this->EndViewTarget()?>
<?
/** **********************************************************************
 ***************************** sections menu *****************************
 ************************************************************************/
$this->SetViewTarget('catalog_sections_menu');

$APPLICATION->IncludeComponent
(
	'bitrix:catalog.section.list', 'menu-vertical',
	[
		'IBLOCK_TYPE'   => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID'     => $arParams['IBLOCK_ID'],

		'SECTION_URL'   => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'TOP_DEPTH'     => 5,

		'CACHE_TYPE'    => $arParams['CACHE_TYPE'],
		'CACHE_TIME'    => $arParams['CACHE_TIME'],
		'CACHE_GROUPS'  => $arParams['CACHE_GROUPS'],

		'ADD_SECTIONS_CHAIN'    => 'N'
	],
	false, ['HIDE_ICONS' => 'Y']
);

$this->EndViewTarget();
/** **********************************************************************
 ****************************** items list *******************************
 ************************************************************************/
$this->SetViewTarget('catalog_items_list');

$APPLICATION->IncludeComponent
(
	'bitrix:catalog.section', '',
	[
		'IBLOCK_TYPE'       => $arResult['OFFERS_IBLOCK_TYPE'],
		'IBLOCK_ID'         => $arResult['OFFERS_IBLOCK_ID'],
		'CATALOG_IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'SECTION_ID'        => '',
		'SECTION_CODE'      => '',

		'SECTION_USER_FIELDS'   => [],
		'FILTER_NAME'           => '',
		'INCLUDE_SUBSECTIONS'   => '',
		'SHOW_ALL_WO_SECTION'   => 'Y',
		'HIDE_NOT_AVAILABLE'    => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

		'ELEMENT_SORT_FIELD'    => $arParams['OFFERS_SORT_FIELD'],
		'ELEMENT_SORT_ORDER'    => $arParams['OFFERS_SORT_ORDER'],
		'ELEMENT_SORT_FIELD2'   => $arParams['OFFERS_SORT_FIELD2'],
		'ELEMENT_SORT_ORDER2'   => $arParams['OFFERS_SORT_ORDER2'],
		'PAGE_ELEMENT_COUNT'    => $arParams['PAGE_ELEMENT_COUNT'],

		'PROPERTY_CODE' => $arResult['OFFERS_IBLOCK_PROPS'],

		'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'DETAIL_URL'  => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],

		'SEF_MODE' => 'N',

		'CACHE_TYPE'   => $arParams['CACHE_TYPE'],
		'CACHE_TIME'   => $arParams['CACHE_TIME'],
		'CACHE_FILTER' => $arParams['CACHE_FILTER'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'SET_TITLE'          => 'N',
		'ADD_SECTIONS_CHAIN' => 'N',

		'PRICE_CODE'        => $arParams['PRICE_CODE'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'CONVERT_CURRENCY'  => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID'       => $arParams['CURRENCY_ID'],

		'PAGER_TEMPLATE'       => $arParams['PAGER_TEMPLATE'],
		'DISPLAY_TOP_PAGER'    => $arParams['DISPLAY_TOP_PAGER'],
		'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],

		'SET_STATUS_404' => $arParams['SET_STATUS_404'],
		'SHOW_404'       => $arParams['SHOW_404'],
		'MESSAGE_404'    => $arParams['MESSAGE_404'],
		'FILE_404'       => $arParams['FILE_404']
	],
	false, ['HIDE_ICONS' => 'Y']
);
$this->EndViewTarget();
/** **********************************************************************
 ********************************* page **********************************
 ************************************************************************/
?>
<div class="alfasintez-catalog">
	<div class="left-col">
		<div class="menu">
			<?$APPLICATION->ShowViewContent('catalog_sections_menu')?>
        </div>
	</div>
	<div class="right-col">
		<div class='items-list'>
			<?$APPLICATION->ShowViewContent('catalog_items_list')?>
		</div>
		<?if( strlen($arResult['IBLOCK_DESCRIPTION']) > 0 ):?>
		<div class="description">
			<?=$arResult['IBLOCK_DESCRIPTION']?>
		</div>
		<?endif?>
	</div>
</div>