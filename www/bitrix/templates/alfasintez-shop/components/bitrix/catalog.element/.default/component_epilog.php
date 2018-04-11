<?
use
	Bitrix\Main\Application,
	Bitrix\Main\Web\Uri,
	Bitrix\Main\Page\Asset;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

$context        = Application::getInstance()->getContext();
$server         = $context->getServer();
$request        = $context->getRequest();
$uri            = new Uri($request->getRequestUri());
$templatePath   = str_replace('/home/bitrix/www',   '',     __DIR__);
$templatePath   = str_replace(DIRECTORY_SEPARATOR,  '/',    $templatePath);

CJSCore::Init(['av', 'font_awesome', 'av_slider']);

Asset::getInstance()->addCss($templatePath.'/css/main.css');
Asset::getInstance()->addCss($templatePath.'/css/images.css');
Asset::getInstance()->addCss($templatePath.'/css/offers.css');

Asset::getInstance()->addJs($templatePath.'/js/images.js');
Asset::getInstance()->addJs($templatePath.'/js/ask_form.js');