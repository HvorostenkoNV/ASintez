<?
/** **********************************************************************
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************* logo **********************************
 ************************************************************************/
?>
<a
   class="logo"
   href="/"
   rel="nofollow"
   tabindex="-1"
>
	<img
		src="<?=Loc::getMessage('AS_COMPANY_INFO_LOGO_ALT')?>"
		alt="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
		title="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
	>
</a>
<?
/** **********************************************************************
 ********************************* menu **********************************
 ************************************************************************/
?>
<div class="menu-cell">
	<?
	$APPLICATION->IncludeComponent
	(
		'bitrix:menu', '',
		[
			'ROOT_MENU_TYPE'     => 'bottom',
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
 ******************************* arrow top *******************************
 ************************************************************************/
?>
<div class="scroll-top-button-cell">
    <div class="button" tabindex="0">
        <i class="fas fa-chevron-circle-up"></i>
    </div>
</div>
<?
/** **********************************************************************
 ********************************** text *********************************
 ************************************************************************/
?>
<div class="additional-text">
	<?$APPLICATION->IncludeFile
	(
		'/include/'.LANGUAGE_ID.'/footer/text.php',
		[],
		[
			'NAME'  => Loc::getMessage('AS_INCLUDINGS_FOOTER_TEXT'),
			'MODE'  => 'text'
		]
	)?>
</div>
<?
/** **********************************************************************
 ******************************* soc links *******************************
 ************************************************************************/
?>
<div class="soc-links-cell">
	<?$APPLICATION->IncludeFile
	(
		'/include/'.LANGUAGE_ID.'/footer/soclinks.php',
		[],
		[
			'NAME'  => Loc::getMessage('AS_INCLUDINGS_FOOTER_SOCLINKS'),
			'MODE'  => 'php'
		]
	)?>
</div>
<?
/** **********************************************************************
 ************************** user agreement link **************************
 ************************************************************************/
?>
<div class="user-agreement-link-cell">
	<a href="<?=Loc::getMessage('AS_USER_AGREEMENT_LINK')?>">
		<?=Loc::getMessage('AS_USER_AGREEMENT_TITLE')?>
    </a>
</div>