<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
?>
<?if($arResult['isFormNote'] == 'Y'):?>
	<?
	/** **********************************************************************
	 ******************************* form sent *******************************
	 ************************************************************************/
	?>
	<div class="alfasintez-form-result-ok">
		<?=Loc::getMessage('AV_FORM_RESULT_OK')?>
	</div>
<?else:?>
	<?
	/** **********************************************************************
	 ********************************* form **********************************
	 ************************************************************************/
	?>
	<div class="alfasintez-form">
		<?if( $arResult['isFormErrors'] == 'Y' ):?>
		<div class="errors-block">
			<?=$arResult['FORM_ERRORS']?>
		</div>
		<?endif?>

		<?=$arResult['FORM_HEADER']?>
			<?foreach( $arResult['FIELDS'] as $fieldInfo ):?>
			<div class="field-row">
				<?
				/** *********************************************
				 **************** checkbox list *****************
				 ***********************************************/
				?>
				<?if( $fieldInfo['TYPE'] == 'checkbox' ):?>
					#CHECKBOX#
				<?
				/** *********************************************
				 ****************** radio list ******************
				 ***********************************************/
				?>
				<?elseif( $fieldInfo['TYPE'] == 'radio' ):?>
					#RADIOLIST#
				<?
				/** *********************************************
				 ********************* list *********************
				 ***********************************************/
				?>
				<?elseif( $fieldInfo['TYPE'] == 'dropdown' ):?>
					#SELECT#
				<?
				/** *********************************************
				 ******************* textarea *******************
				 ***********************************************/
				?>
				<?elseif( $fieldInfo['TYPE'] == 'textarea' ):?>
					#TEXTAREA#
				<?
				/** *********************************************
				 ******************** phone *********************
				 ***********************************************/
				?>
				<?elseif( $fieldInfo['TYPE'] == 'phone' ):?>
					#PHONE#
				<?
				/** *********************************************
				 ****************** file/image ******************
				 ***********************************************/
				?>
				<?elseif( $fieldInfo['TYPE'] == 'file' || $fieldInfo['TYPE'] == 'image' ):?>
					#FILE#
				<?
				/** *********************************************
				 ******************** input *********************
				 ***********************************************/
				?>
				<?else:?>
					<?
					$APPLICATION->IncludeComponent
					(
						'alfasintez:form.input', '',
						[
							'NAME'     => $fieldInfo['NAME'],
							'VALUE'    => $fieldInfo['VALUE'],
							'TITLE'    => $fieldInfo['TITLE'],
							'REQUIRED' => $fieldInfo['REQUIRED']
						],
						false, ['HIDE_ICONS' => 'Y']
					);
					?>
				<?endif?>
			</div>
			<?endforeach?>

			<div class="buttons-row">
				<?$APPLICATION->IncludeComponent
				(
					'alfasintez:form.button', '',
					[
						'BUTTON_TYPE' => 'submit',
						'NAME'        => 'web_form_submit',
						'TITLE'       => $arResult['arForm']['BUTTON']
					],
					false, ['HIDE_ICONS' => 'Y']
				)?>
			</div>
		<?=$arResult['FORM_FOOTER']?>
	</div>
<?endif?>