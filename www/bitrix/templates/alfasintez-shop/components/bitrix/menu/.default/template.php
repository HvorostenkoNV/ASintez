<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult) <= 0 ) return;
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
?>
<?foreach( $arResult as $item ):?>
<a
    class="alfasintez-menu-item<?if( $item['SELECTED'] ):?> selected<?endif?>"
    href="<?=$item['LINK']?>"
    <?if( $item['SELECTED'] ):?>rel="nofollow"<?endif?>
>
    <?=$item['TEXT']?>
</a>
<?endforeach?>