<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* image *********************************
 ************************************************************************/
?>
<div class="main-image">
    <img
        src="<?=$arResult['IMAGES'][0]['SRC']?>"
        alt="<?=$arResult['IMAGES'][0]['ALT']?>"
        title="<?=$arResult['IMAGES'][0]['TITLE']?>"
    >
</div>
<?
/** **********************************************************************
 **************************** preview slider *****************************
 ************************************************************************/
?>
<?if( count($arResult['IMAGES']) > 1 ):?>
<div class="slider">
	<div class="navigation back">
		<i class="fas fa-angle-left"></i>
	</div>

	<div class="slider-block">
		<?foreach( $arResult['IMAGES'] as $item ):?>
		<div class="item">
			<img
				src="<?=$item['SRC']?>"
				alt="<?=$arResult['NAME']?>"
				title="<?=$arResult['NAME']?>"
			>
		</div>
		<?endforeach?>
	</div>

	<div class="navigation next">
		<i class="fas fa-angle-right"></i>
	</div>
</div>
<?endif?>
<?
/** **********************************************************************
 ***************************** image viewer ******************************
 ************************************************************************/
?>
<div class="
	alfasintez-catalog-items-detail-viewer
	<?if( count($arResult['IMAGES']) > 1 ):?>with-slider<?endif?>
	"
>
	<div class="close">
		<i class="fas fa-times"></i>
	</div>

	<div class="title">
		<?=$arResult['NAME']?>
	</div>

	<div class="body">
		<div class="main-slider">
			<div class="navigation back">
				<i class="fas fa-angle-left"></i>
			</div>

			<div class="slider-block">
				<?foreach( $arResult['IMAGES'] as $item ):?>
				<div class="item">
					<img
						src="<?=$item['SRC']?>"
						alt="<?=$arResult['NAME']?>"
						title="<?=$arResult['NAME']?>"
					>
				</div>
				<?endforeach?>
			</div>

			<div class="navigation next">
				<i class="fas fa-angle-right"></i>
			</div>
		</div>

		<?if( count($arResult['IMAGES']) > 1 ):?>
		<div class="vertical-slider">
			<div class="navigation back">
				<i class="fas fa-angle-up"></i>
			</div>

			<div class="slider-block">
				<?foreach( $arResult['IMAGES'] as $item ):?>
				<div class="item">
					<img
						src="<?=$item['SRC']?>"
						alt="<?=$arResult['NAME']?>"
						title="<?=$arResult['NAME']?>"
					>
				</div>
				<?endforeach?>
			</div>

			<div class="navigation next">
				<i class="fas fa-angle-down"></i>
			</div>
		</div>
		<?endif?>
	</div>
</div>
<?
/** **********************************************************************
 ****************************** categories *******************************
 ************************************************************************/
?>