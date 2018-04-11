<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['PAGES_LIST']) <= 0 ) return;
/** **********************************************************************
 ********************************* pager *********************************
 ************************************************************************/
?>
<div class="alfasintez-pager">
	<?foreach( $arResult['PAGES_LIST'] as $item ):?>
		<?
		/** *********************************************
		 ****************** back button *****************
		 ***********************************************/
		?>
		<?if( $item['TYPE'] == 'SWITCHER-BACK' ):?>
		<a class="switcher back" href="<?=$item['LINK']?>" rel="nofollow">
			<i class="fas fa-chevron-left"></i>
		</a>
		<?endif?>
		<?
		/** *********************************************
		 **************** forward button ****************
		 ***********************************************/
		?>
		<?if( $item['TYPE'] == 'SWITCHER-FORWARD' ):?>
		<a class="switcher forward" href="<?=$item['LINK']?>" rel="nofollow">
			<i class="fas fa-chevron-right"></i>
		</a>
		<?endif?>
		<?
		/** *********************************************
		 ********************* page *********************
		 ***********************************************/
		?>
		<?if( $item['TYPE'] == 'PAGE' ):?>
		<a
			class="page<?if( $item['SELECTED'] ):?> selected<?endif?>"
			href="<?=$item['LINK']?>"
			<?if( $item['SELECTED'] ):?>rel="nofollow"<?endif?>
		>
			<?=$item['VALUE']?>
		</a>
		<?endif?>
		<?
		/** *********************************************
		 ********************* space ********************
		 ***********************************************/
		?>
		<?if( $item['TYPE'] == 'SPACE' ):?>
		<div class="space">...</div>
		<?endif?>
	<?endforeach?>
</div>