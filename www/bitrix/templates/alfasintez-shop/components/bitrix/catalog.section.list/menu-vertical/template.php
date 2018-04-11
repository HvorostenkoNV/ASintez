<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['SECTIONS_BLOCKS']) <= 0) return;
/** **********************************************************************
 ************************** public edit buttons **************************
 ************************************************************************/
foreach( $arResult['SECTIONS'] as $item )
{
	$this->AddEditAction  ($item['ID'], $item['EDIT_LINK'],   CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT'));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE'));
}
/** **********************************************************************
 ***************************** sections menu *****************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-sections-menu">
	<?foreach( $arResult['SECTIONS_BLOCKS'] as $sectionBlock ):?>
	<div class="sections-block<?if($arParams['DISPLAY_TYPE'] == 'CLOSED'):?> closed<?endif?>">
		<div class="head">
			<a
				href="<?=$sectionBlock['PARENT']['SECTION_PAGE_URL']?>"
				title="<?=$sectionBlock['PARENT']['NAME']?>"
			>
				<?=$sectionBlock['PARENT']['NAME']?>
			</a>
			<?if( count($sectionBlock['CHILDREN']) > 0 ):?>
			<div class="open-button" tabindex="0">
				<i class="fas fa-times"></i>
			</div>
			<?endif?>
		</div>
		<?if( count($sectionBlock['CHILDREN']) > 0 ):?>
		<ul class="body">
			<?foreach( $sectionBlock['CHILDREN'] as $item ):?>
			<li class="depth-<?=$item['DEPTH_LEVEL']?>">
				<a href="<?=$item['SECTION_PAGE_URL']?>" title="<?=$item['NAME']?>">
					<?=$item['NAME']?>
				</a>
			</li>
			<?endforeach?>
		</ul>
		<?endif?>
	</div>
	<?endforeach?>
</div>