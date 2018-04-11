<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ************************** public edit buttons **************************
 ************************************************************************/
$panelButtonsInfo = CIBlock::GetPanelButtons($arResult['IBLOCK_ID'], $arResult['ID']);
$this->AddEditAction  ($arResult['ID'], $panelButtonsInfo['edit']['edit_element']  ['ACTION_URL'], CIBlock::GetArrayByID($arResult['IBLOCK_ID'], 'ELEMENT_EDIT'));
$this->AddDeleteAction($arResult['ID'], $panelButtonsInfo['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arResult['IBLOCK_ID'], 'ELEMENT_DELETE'));
/** **********************************************************************
 ********************************* page **********************************
 ************************************************************************/
?>
<div
    class="
        alfasintez-catalog-items-detail
        <?if( count($arResult['IMAGES']) > 0 ):?>
        with-images
        <?endif?>
        "
    id="<?=$this->GetEditAreaId($arResult['ID'])?>"
>
	<?if( count($arResult['IMAGES']) > 0 ):?>
	<div class="images">
		<?include 'page_parts'.DIRECTORY_SEPARATOR.'images.php'?>
	</div>
	<?endif?>

	<div class="preview">
		<div class="title">
			<?=Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_PREVIEW')?>
		</div>
		<?=$arResult['PREVIEW_TEXT']?>
	</div>

	<?if( $arResult['ASK_FORM_ID'] > 0 ):?>
	<div class="ask-form">
		<?include 'page_parts'.DIRECTORY_SEPARATOR.'ask_form.php'?>
	</div>
	<?endif?>

	<?if( count($arResult['OFFERS']) > 0 ):?>
	<div class="offers">
		<?include 'page_parts'.DIRECTORY_SEPARATOR.'offers.php'?>
	</div>
	<?endif?>

	<div class="additional">
		<?include 'page_parts'.DIRECTORY_SEPARATOR.'additional.php'?>
	</div>

	<div class="detail">
		<?=$arResult['DETAIL_TEXT']?>
	</div>
</div>