<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* input *********************************
 ************************************************************************/
?>
<div
    data-av-form-item="input"
    data-av-form-library="alfasintez"
    class="alfasintez-form-input<?if( $arResult['REQUIRED'] ):?> required<?endif?>"
	<?=$arResult['ATTR']?>
>
	<?if( $arResult['REQUIRED'] ):?>
    <i
        class="alert-icon fas fa-exclamation-circle"
        title="<?=Loc::getMessage('ALFASINTEZ_FORM_INPUT_REQUIRED')?>"
    ></i>
    <?endif?>
    <input
        type="text"
        name="<?=$arResult['NAME']?>"
        value="<?=$arResult['VALUE']?>"
        title="<?=$arResult['TITLE']?>"
        placeholder="<?=$arResult['TITLE']?><?if( $arResult['REQUIRED'] ):?> *<?endif?>"
    >
</div>