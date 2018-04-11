<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['ROOT_SECTIONS']) <= 0 ) return;
/** **********************************************************************
 *********************** sections filter preparing ***********************
 ************************************************************************/
foreach( $arResult['ROOT_SECTIONS'] as $index => $section )
{
	if( count($section['OFFERS']) <= 0 )
	{
		unset($arResult['ROOT_SECTIONS'][$index]);
		continue;
	}

	$filterName = 'CATALOG_SECTION_SLIDER_FILTER_'.$section['ID'];
	$GLOBALS[$filterName] = ['ID' => $section['OFFERS']];
	$arResult['ROOT_SECTIONS'][$index]['FILTER_NAME'] = $filterName;
}
/** **********************************************************************
 ************************ sections default images ************************
 ************************************************************************/
foreach( $arResult['ROOT_SECTIONS'] as $index => $section )
	if( strlen($section['PICTURE']) <= 0 )
		$arResult['ROOT_SECTIONS'][$index]['PICTURE'] = $this->GetFolder().'/images/default_image.svg';
/** **********************************************************************
 ********************************* page **********************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-preview">
	<?foreach( $arResult['ROOT_SECTIONS'] as $section ):?>
	<div class="section">
		<div class="image">
			<a href="<?=$section['LINK']?>">
				<?=$section['NAME']?>
			</a>
			<img
				src="<?=$section['PICTURE']?>"
				alt="<?=$section['NAME']?>"
				title="<?=$section['NAME']?>"
			>
		</div>
		<div class="list">
			<?$APPLICATION->IncludeComponent
			(
				'bitrix:catalog.section', 'slider',
				[
					'IBLOCK_TYPE'       => $arResult['OFFERS_IBLOCK_TYPE'],
					'IBLOCK_ID'         => $arResult['OFFERS_IBLOCK_ID'],
					'CATALOG_IBLOCK_ID' => $arParams['IBLOCK_ID'],
					'SECTION_ID'        => '',
					'SECTION_CODE'      => '',

					'SECTION_USER_FIELDS'   => [],
					'FILTER_NAME'           => $section['FILTER_NAME'],
					'INCLUDE_SUBSECTIONS'   => $arParams['INCLUDE_SUBSECTIONS'],
					'SHOW_ALL_WO_SECTION'   => '',
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

					'SET_STATUS_404' => $arParams['SET_STATUS_404'],
					'SHOW_404'       => $arParams['SHOW_404'],
					'MESSAGE_404'    => $arParams['MESSAGE_404'],
					'FILE_404'       => $arParams['FILE_404']
				],
				false, ['HIDE_ICONS' => 'Y']
			);?>
		</div>
	</div>
	<?endforeach?>
</div>