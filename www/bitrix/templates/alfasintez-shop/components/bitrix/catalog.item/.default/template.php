<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 *************************** item preprocessor ***************************
 ************************************************************************/
if( !array_key_exists('SRC', $arResult['PREVIEW_PICTURE']) || strlen($arResult['PREVIEW_PICTURE']['SRC']) <= 0 )
	$arResult['PREVIEW_PICTURE']['SRC'] = $this->GetFolder().'/images/default_image.svg';

$arResult['MIN_PRICE'] = 0;
foreach( $arResult['PRICES_INFO'] as $item )
	if( $item['MIN'] )
    {
	    $arResult['MIN_PRICE'] = $item['TITLE'];
	    break;
    }

$nameMaxLength  = 30;
$addingChars    = '...';

$arResult['NAME_SHORTED'] = $arResult['NAME'];
if( strlen($arResult['NAME_SHORTED']) > $nameMaxLength )
    $arResult['NAME_SHORTED'] =
        substr($arResult['NAME_SHORTED'], 0, $nameMaxLength - strlen($addingChars)).
        $addingChars;
/** **********************************************************************
 ********************************* item **********************************
 ************************************************************************/
?>
<div class="alfasintez-catalog-item-preview" tabindex="0">
    <?
    /** *********************************************
     ********************* image ********************
     ***********************************************/
    ?>
    <a class="image" href="<?=$arResult['DETAIL_PAGE_URL']?>" rel="nofollow" tabindex="-1">
        <img
            src='<?=$arResult['PREVIEW_PICTURE']['SRC']?>'
            title='<?=$arResult['PREVIEW_PICTURE']['TITLE']?>'
            alt='<?=$arResult['PREVIEW_PICTURE']['ALT']?>'
        >
    </a>
	<?
	/** *********************************************
	 ********************* title ********************
	 ***********************************************/
	?>
    <a class="title shorted" href="<?=$arResult['DETAIL_PAGE_URL']?>" title="<?=$arResult['NAME']?>" tabindex="-1">
        <?=$arResult['NAME_SHORTED']?>
    </a>
    <a class="title native" href="<?=$arResult['DETAIL_PAGE_URL']?>" title="<?=$arResult['NAME']?>" tabindex="-1">
        <?=$arResult['NAME']?>
    </a>
	<?
	/** *********************************************
	 ******************** rating ********************
	 ***********************************************/
	?>
    <div class="rating">
        #RATING#
    </div>
	<?
	/** *********************************************
	 ******************** props *********************
	 ***********************************************/
	?>
    <?if( count($arResult['DISPLAY_PROPERTIES']) > 0 ):?>
    <div class="props">
        <?foreach( $arResult['DISPLAY_PROPERTIES'] as $item ):?>
        <span>
            <?=$item['NAME']?>: <?=(strlen($item['VALUE_ENUM']) > 0 ? $item['VALUE_ENUM'] : $item['VALUE'])?>
        </span>
        <?endforeach?>
    </div>
    <?endif?>
	<?
	/** *********************************************
	 ******************** price *********************
	 ***********************************************/
	?>
	<?if( $arResult['MIN_PRICE'] > 0 ):?>
    <div class="price">
        <span class="title">
            <?=Loc::getMessage('ALFASINTEZ_CATALOG_ITEM_PREVIEW_PRICE_TITLE')?>
        </span>
        <span class="space"></span>
        <span>
            <?=Loc::getMessage('ALFASINTEZ_CATALOG_ITEM_PREVIEW_PRICE_VALUE', ['#VALUE#' => $arResult['MIN_PRICE']])?>
        </span>
    </div>
	<?endif?>
	<?
	/** *********************************************
	 ****************** read more *******************
	 ***********************************************/
	?>
    <div class="read-more">
        <a
            class="link"
            href="<?=$arResult['DETAIL_PAGE_URL']?>"
            title="<?=Loc::getMessage('ALFASINTEZ_CATALOG_ITEM_PREVIEW_READ_MORE_TITLE')?>"
            rel="nofollow"
            tabindex="-1"
        >
		    <?=Loc::getMessage('ALFASINTEZ_CATALOG_ITEM_PREVIEW_READ_MORE')?>
        </a>
        <a
            class="icon"
            href="<?=$arResult['DETAIL_PAGE_URL']?>"
            rel="nofollow"
            tabindex="-1"
        >
            <i class="fas fa-paper-plane"></i>
        </a>
    </div>
</div>