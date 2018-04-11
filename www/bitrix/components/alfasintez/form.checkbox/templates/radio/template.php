<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
?>
<div
	data-av-form-item="radio"
    data-av-form-library="alfasintez"
    class="
        alfasintez-form-radio
        <?if( $arResult['REQUIRED'] ):?>required<?endif?>
        <?if( $arResult['CHECKED'] ):?>checked<?endif?>
        "
	title="<?=$arResult['TITLE']?>"
	<?=$arResult['ATTR']?>
>
	<input
		type="radio"
		name="<?=$arResult['NAME']?>"
		value="<?=$arResult['VALUE']?>"
		title=""
		<?if( $arResult['CHECKED'] ):?>checked<?endif?>
	>
	<div class="icon">
        <i class="fas fa-circle"></i>
    </div>
	<?if( $arResult['TITLE'] ):?>
	<label><?=$arResult['TITLE']?></label>
	<?endif?>
</div>