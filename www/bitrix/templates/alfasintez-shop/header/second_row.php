<?
/** **********************************************************************
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************** menu *********************************
 ************************************************************************/
?>
<div class="menu-cell">
	<?
	$APPLICATION->IncludeComponent
	(
		'bitrix:menu', '',
		[
			'ROOT_MENU_TYPE'     => 'top',
			'MAX_LEVEL'          => 1,
			'CHILD_MENU_TYPE'    => '',
			'USE_EXT'            => 'N',
			'DELAY'              => 'N',
			'ALLOW_MULTI_SELECT' => 'N',

			'MENU_CACHE_TYPE'       => 'A',
			'MENU_CACHE_TIME'       => 360000,
			'MENU_CACHE_USE_GROUPS' => 'Y'
		],
		false, ['HIDE_ICONS' => true]
	);
	?>
</div>
<?
/** **********************************************************************
 *********************** call back form call button **********************
 ************************************************************************/
?>
<div class="call-back-call-cell">
	<?
	$APPLICATION->IncludeComponent
	(
		'alfasintez:form.button', 'alt-inverted',
		[
			'BUTTON_TYPE' => 'label',
			'TITLE'       => Loc::getMessage('AS_CALL_BACK_FORM_CALL_BUTTON')
		],
		false, ['HIDE_ICONS' => 'Y']
	);
	?>
</div>