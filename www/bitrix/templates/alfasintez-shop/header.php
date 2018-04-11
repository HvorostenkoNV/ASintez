<?
/** ***********************************************************************************************
 * @var CMain $APPLICATION
 *************************************************************************************************/
use
	Bitrix\Main\Application,
	Bitrix\Main\Page\Asset,
	Bitrix\Main\Web\Uri,
	Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

Loc::loadMessages(__FILE__);
/** ***********************************************************************************************
 ******************************************* VARIABLES ********************************************
 *************************************************************************************************/
$context        = Application::getInstance()->getContext();
$server         = $context->getServer();
$request        = $context->getRequest();
$uri            = new Uri($request->getRequestUri());
$dirProperty    = $APPLICATION->GetDirPropertyList();

$isMainPage     = $uri->getPath() == '/';
$showBreadcrumb = $dirProperty['HIDE_NAV_CHAIN']  != 'Y' && !$isMainPage && ERROR_404 != 'Y';
$showH1         = $dirProperty['HIDE_MAIN_TITLE'] != 'Y' && !$isMainPage && ERROR_404 != 'Y';
$fullscreenPage = $dirProperty['FULLSCREEN_PAGE'] == 'Y' || $isMainPage;
/** ***********************************************************************************************
 ******************************************** DOCUMENT ********************************************
 *************************************************************************************************/
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="<?=LANGUAGE_ID?>">
	<?
	/** **********************************************************************
	 ********************************** HEAD *********************************
	 ************************************************************************/
	?>
	<head>
		<meta itemprop="inLanguage" content="<?=LANGUAGE_ID?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
		<title><?$APPLICATION->ShowTitle()?></title>
		<link rel="icon" type="image/x-icon" href="/favicon.ico">

		<?$APPLICATION->ShowHead()?>
		<?CJSCore::Init(['av', 'font_awesome'])?>
		<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/scripts/main.js')?>
	</head>
	<?
	/** **********************************************************************
	 ********************************** BODY *********************************
	 ************************************************************************/
	?>
	<body>
		<?$APPLICATION->ShowPanel()?>
		<?
		/** *********************************************
		 ************ organization microdata ************
		 ***********************************************/
		?>
		<div itemscope itemtype="http://schema.org/Organization">
			<span itemprop="name"        content="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"></span>
			<span itemprop="description" content="<?=Loc::getMessage('AS_COMPANY_INFO_DESCRIPTION')?>"></span>
			<span itemprop="url"         content="<?=Loc::getMessage('AS_COMPANY_INFO_SITE')?>"></span>
			<span itemprop="email"       content="<?=Loc::getMessage('AS_COMPANY_INFO_EMAIL')?>"></span>
			<?foreach( explode('|', Loc::getMessage('AS_COMPANY_INFO_PHONES')) as $phone):?>
			<span itemprop="telephone"   content="<?=$phone?>"></span>
			<?endforeach?>

			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="addressCountry"  content="<?=Loc::getMessage('AS_COMPANY_INFO_COUNTRY')?>"></span>
				<span itemprop="addressLocality" content="<?=Loc::getMessage('AS_COMPANY_INFO_CITY')?>"></span>
				<span itemprop="streetAddress"   content="<?=Loc::getMessage('AS_COMPANY_INFO_STREET')?>"></span>
			</div>

			<div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
				<span itemprop="caption" content="<?=Loc::getMessage('AS_COMPANY_INFO_NAME')?>"></span>
				<span itemprop="url"     content="<?=CURRENT_PROTOCOL?>://<?=$server->getServerName().Loc::getMessage('AS_COMPANY_INFO_LOGO')?>"></span>
				<span itemprop="width"   content="300"></span>
				<span itemprop="height"  content="50"></span>
			</div>
		</div>
		<?
		/** *********************************************
		 ******************** header ********************
		 ***********************************************/
		?>
		<header
			itemscope itemtype="http://schema.org/WPHeader"
			<?if($isMainPage):?>
			class="main-page"
			<?endif?>
		>
			<div class="first-row page-responsive-block"><?include 'header/first_row.php'?></div>
			<div class="second-row"><?include 'header/second_row.php'?></div>
			<?if($isMainPage):?>
			<div class="third-row page-responsive-block"><?include 'header/third_row.php'?></div>
			<div class="bottom-frame"></div>
			<?endif?>
		</header>
		<?
		/** *********************************************
		 **************** call back form ****************
		 ***********************************************/
		?>
		<div id="call-back-form">
			<div class="close">
				<i class="fas fa-times"></i>
			</div>
			<div class="title"><?=Loc::getMessage('AS_CALL_BACK_FORM_TITLE')?></div>
			<div class="body">
				<?$APPLICATION->IncludeFile
				(
					'/include/'.LANGUAGE_ID.'/header/callback_form.php',
					[],
					[
						'NAME'  => Loc::getMessage('AS_INCLUDINGS_CALLBACK_FORM'),
						'MODE'  => 'php'
					]
				)?>
			</div>
		</div>
		<?
		/** *********************************************
		 *************** catalog sections ***************
		 ***********************************************/
		?>
		<div class="page-responsive-block">
			<?$APPLICATION->ShowViewContent('catalog_sections_slider')?>
		</div>
		<?
		/** *********************************************
		 ****************** breadcrumb ******************
		 ***********************************************/
		?>
		<?if($showBreadcrumb):?>
		<div id="page-breadcrumb" class="page-responsive-block">
			<?$APPLICATION->IncludeComponent
			(
				'bitrix:breadcrumb', '',
				[],
				false, ['HIDE_ICONS' => 'Y']
			)?>
		</div>
		<?endif?>
		<?
		/** *********************************************
		 ********************** H1 **********************
		 ***********************************************/
		?>
		<?if($showH1):?>
		<div id="page-title" class="page-responsive-block">
			<div class="page-block-title">
				<h1 class="title"><?$APPLICATION->ShowTitle(false)?></h1>
			</div>
		</div>
		<?endif?>
		<?
		/** *********************************************
		 ********************* body *********************
		 ***********************************************/
		?>
		<div
			id="page-workarea"
			class=
				"
				<?if($fullscreenPage):?>full-screen
				<?else:?>page-responsive-block
				<?endif?>
				"
		>