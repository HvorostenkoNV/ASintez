<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* button ********************************
 ************************************************************************/
?>
<?if($arResult['BUTTON_TYPE'] == 'button' && $arResult['NAME']):?>
<button
	class="alfasintez-form-button-alt"
	name="<?=$arResult['NAME']?>"
	value="<?=$arResult['VALUE']?>"
	title="<?=$arResult['PLACEHOLDER']?>"
	<?=$arResult['ATTR']?>
>
	<?=$arResult['TITLE']?>
</button>
<?endif?>
<?
/** **********************************************************************
 ********************************* label *********************************
 ************************************************************************/
?>
<?if($arResult['BUTTON_TYPE'] == 'label'):?>
<span
	class="alfasintez-form-button-alt"
	title="<?=$arResult['PLACEHOLDER']?>"
	tabindex="0"
	<?=$arResult['ATTR']?>
>
	<?=$arResult['TITLE']?>
</span>
<?endif?>
<?
/** **********************************************************************
 ********************************** link *********************************
 ************************************************************************/
?>
<?if($arResult['BUTTON_TYPE'] == 'link' && $arResult['LINK']):?>
<a
	class="alfasintez-form-button-alt"
	href="<?=$arResult['LINK']?>"
	title="<?=$arResult['PLACEHOLDER']?>"
	<?=$arResult['ATTR']?>
>
	<?=$arResult['TITLE']?>
</a>
<?endif?>
<?
/** **********************************************************************
 ********************************* submit ********************************
 ************************************************************************/
?>
<?if($arResult['BUTTON_TYPE'] == 'submit' && $arResult['NAME']):?>
<input
	class="alfasintez-form-button-alt"
	type="submit"
	name="<?=$arResult['NAME']?>"
	value="<?=$arResult['TITLE']?>"
	title="<?=$arResult['PLACEHOLDER']?>"
	<?=$arResult['ATTR']?>
>
<?endif?>