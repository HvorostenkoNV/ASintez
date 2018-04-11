<?
use Bitrix\Main\Localization\Loc;

if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ********************************** logo *********************************
 ************************************************************************/
?>
<a
	class="logo"
	href="/"
	<?if($isMainPage):?>rel="nofollow"<?endif?>
	tabindex="-1"
>
	<img
		src="<?=Loc::getMessage('AS_COMPANY_INFO_LOGO')?>"
		alt="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
		title="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
	>
</a>
<a
	class="logo-mobile"
	href="/"
	rel="nofollow"
	tabindex="-1"
>
	<img
		src="<?=Loc::getMessage('AS_COMPANY_INFO_LOGO_MOBILE')?>"
		alt="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
		title="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"
	>
</a>
<?
/** **********************************************************************
 ********************************* search ********************************
 ************************************************************************/
?>
<div class="search-cell">
	<?$APPLICATION->IncludeFile
	(
		'/include/'.LANGUAGE_ID.'/header/search.php',
		[],
		[
			'NAME'  => Loc::getMessage('AS_INCLUDINGS_HEADER_SEARCH'),
			'MODE'  => 'php'
		]
	)?>
</div>