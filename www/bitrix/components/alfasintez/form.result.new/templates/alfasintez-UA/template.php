<div class="alfasintez-call-back-form">
	<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	/* -------------------------------------------------------------------- */
	/* --------------------------- form sended ---------------------------- */
	/* -------------------------------------------------------------------- */
	?>
	<?if($arResult["isFormNote"] == 'Y'):?>
		<div class="av-form-result-ok text-center"><?=GetMessage("AV_FORM_RESULT_OK_MESSAGE")?></div>
	<?endif?>



	<?if ($arResult["isFormNote"] != "Y")
	{
		?>
		<?=$arResult["FORM_HEADER"]?>

		<?
		/***********************************************************************************
		form header
		 ***********************************************************************************/
		?>
		<div class="alfasintez-form-title text-center text-uppercase">
			<?=$arResult["FORM_TITLE"]?>
		</div>
		<div class="inputErrors">
			<?=$arResult["FORM_DESCRIPTION"]?>
			<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
		</div>
	

		<?
	/***********************************************************************************
							                form questions
	***********************************************************************************/
	?>
		<?
		foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
		{
			?>
			<div class="alfasintez-question-<?=$arQuestion["STRUCTURE"]["0"]["ID"]?>">
			<?
			if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
			{
				echo $arQuestion["HTML_CODE"];
			}
			else
			{
		?>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
					<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
					<?endif;?>
				
					<?=$arQuestion["IMAGE"]["HTML_CODE"]?>
				<?=$arQuestion["HTML_CODE"]?><br>
		<?
			} ?>
			</div>
		<?
		} //endwhile
		?>
		<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" class="alfasintez-form-submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
	<?=$arResult["FORM_FOOTER"]?>
	<? } //endif (isFormNote)?>
</div>
