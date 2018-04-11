<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['SECTIONS']) <= 0) return;
/** **********************************************************************
 ************************** public edit buttons **************************
 ************************************************************************/
foreach( $arResult['SECTIONS'] as $item )
{
	$this->AddEditAction  ($item['ID'], $item['EDIT_LINK'],   CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT'));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE'));
}
/** **********************************************************************
 ************************** items preprocessor ***************************
 ************************************************************************/
foreach( $arResult['SECTIONS'] as $index => $item )
	if( !array_key_exists('SRC', $item['PICTURE']) || strlen($item['PICTURE']['SRC']) <= 0 )
	    $arResult['SECTIONS'][$index]['PICTURE']['SRC'] = $this->GetFolder().'/images/default_image.svg';
/** **********************************************************************
 ****************************** list slider ******************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-sections-slider">
	<div class="navigation prev">
		<i class="fas fa-angle-left"></i>
	</div>

	<div class="slider-block">
		<?foreach( $arResult['SECTIONS'] as $item ):?>
        <div class="item" id="<?=$this->GetEditAreaId($item['ID'])?>">
            <a href="<?=$item['SECTION_PAGE_URL']?>">
	            <?=$item['NAME']?>
            </a>
            <img
                src="<?=$item['PICTURE']['SRC']?>"
                title="<?=$item['PICTURE']['TITLE']?>"
                alt="<?=$item['PICTURE']['ALT']?>"
            >
        </div>
		<?endforeach?>
	</div>

	<div class="navigation next">
		<i class="fas fa-angle-right"></i>
	</div>
</div>