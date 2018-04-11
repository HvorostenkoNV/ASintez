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
if( count($arResult['ITEMS']) > 0 )
    foreach( $arResult['ITEMS'] as $item )
    {
        $this->AddEditAction  ($item['ID'], $item['EDIT_LINK'],   CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_DELETE'));
    }
/** **********************************************************************
 ****************************** empty list *******************************
 ************************************************************************/
?>
<?if( count($arResult['ITEMS']) <= 0 ):?>
    <div class="alfasintez-catalog-items-list-empty">
        <?=Loc::getMessage('ALFASINTEZ_CATALOG_SECTION_EMPTY_LIST')?>
    </div>
<?else:?>
<?
/** **********************************************************************
 ********************************** list *********************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-items-list">
	<?if( $arParams['DISPLAY_TOP_PAGER'] == 'Y' && strlen($arResult['NAV_STRING']) > 0 ):?>
	<div class="pager top">
		<?=$arResult['NAV_STRING']?>
	</div>
	<?endif?>

	<div class="list">
		<?foreach( $arResult['ITEMS'] as $item ):?>
		<div class="item" id="<?=$this->GetEditAreaId($item['ID'])?>">
			<?
			$APPLICATION->IncludeComponent
			(
				'bitrix:catalog.item', '',
				[
					'RESULT' => ['ITEM' => $item]
				],
				false, ['HIDE_ICONS' => 'Y']
			);
			?>
		</div>
		<?endforeach?>
	</div>

	<?if( $arParams['DISPLAY_BOTTOM_PAGER'] == 'Y' && strlen($arResult['NAV_STRING']) > 0 ):?>
	<div class="pager bottom">
		<?=$arResult['NAV_STRING']?>
	</div>
	<?endif?>
</div>
<?endif?>