<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************** search *********************************
 ************************************************************************/
?>
<div
	class="alfasintez-shop-search-title"
	data-search-id="<?=$arParams['INPUT_ID']?>"
	data-search-page="<?=$arResult['FORM_ACTION']?>?q=#SEACRH#"
	data-empty-result-title="<?=Loc::getMessage('AV_SHOP_SEARCH_TITLE_EMPTY_RESULT')?>"
>
	<input
		type="text"
		name="q"
		title="<?=Loc::getMessage('AV_SHOP_SEARCH_TITLE_PLACEHOLDER')?>"
		autocomplete="off"
	>
	<i class="icon fas fa-search"></i>
</div>
<div
	class="alfasintez-shop-search-title-result"
	data-search-id="<?=$arParams['INPUT_ID']?>"
	data-empty="Y"
>
</div>