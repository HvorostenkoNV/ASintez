<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ****************************** call button ******************************
 ************************************************************************/
$APPLICATION->IncludeComponent
(
	'alfasintez:form.button', '',
	[
		'BUTTON_TYPE'   => 'label',
		'TITLE'         => Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_ASK_FORM_CALL'),
		'ATTR'          => ['data-call-ask-form' => 'Y']
	],
	false, ['HIDE_ICONS' => 'Y']
);
/** **********************************************************************
 ******************************** ask form *******************************
 ************************************************************************/
?>
<div
    class="alfasintez-catalog-items-detail-ask-form"
    data-link-field-id="<?=$arParams['ASK_FORM_LINK_FIELD_ID']?>"
    data-item-link="<?=$arResult['ITEM_ADMIN_LINK']?>"
>
	<div class="close">
		<i class="fas fa-times"></i>
	</div>
	<div class="title">
		<?=Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_ASK_FORM_TITLE')?>
	</div>
	<div class="body">
		<?$APPLICATION->IncludeComponent
		(
			'bitrix:form.result.new', '',
			[
				'AJAX_MODE'           => 'Y',
				'AJAX_OPTION_JUMP'    => 'N',
				'AJAX_OPTION_STYLE'   => 'N',
				'AJAX_OPTION_HISTORY' => 'N',

				'SEF_MODE'    => 'N',
				'WEB_FORM_ID' => $arResult['ASK_FORM_ID'],

				'START_PAGE'     => 'new',
				'SHOW_LIST_PAGE' => 'N',
				'SHOW_EDIT_PAGE' => 'N',
				'SHOW_VIEW_PAGE' => 'N',
				'SUCCESS_URL'    => '',

				'SHOW_ANSWER_VALUE'      => 'N',
				'SHOW_ADDITIONAL'        => 'N',
				'SHOW_STATUS'            => 'N',
				'EDIT_ADDITIONAL'        => 'N',
				'EDIT_STATUS'            => 'N',
				'IGNORE_CUSTOM_TEMPLATE' => 'N',
				'USE_EXTENDED_ERRORS'    => 'N',

				'CACHE_TYPE' => 'A',
				'CACHE_TIME' => 360000
			],
			false, ['HIDE_ICONS' => 'Y']
		)?>
	</div>
</div>