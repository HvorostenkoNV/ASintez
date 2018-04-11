<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['ITEMS']) <= 0 ) return;
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
 ********************************** list *********************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-items-slider">
    <div class="navigation prev">
        <i class="fas fa-angle-left"></i>
    </div>

	<div class="slider-block">
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

    <div class="navigation next">
        <i class="fas fa-angle-right"></i>
    </div>
</div>