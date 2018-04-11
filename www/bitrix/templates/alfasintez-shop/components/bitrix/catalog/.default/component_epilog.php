<?
use
	Bitrix\Main\Application,
	Bitrix\Main\Web\Uri,
	Bitrix\Main\Page\Asset;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

$context            = Application::getInstance()->getContext();
$server             = $context->getServer();
$request            = $context->getRequest();
$uri                = new Uri($request->getRequestUri());
$templatePath       = str_replace('/home/bitrix/www', '', __DIR__);
$templatePath       = str_replace(DIRECTORY_SEPARATOR, '/', $templatePath);
$templatePathHttp   = $uri->getScheme().'://'.$server->getServerName().$templatePath;

CJSCore::Init(['av']);
Asset::getInstance()->addString('<script>AlfasintezCatalogSectionListRefresh = "'.$templatePathHttp.'/ajax/list_refresh.php";</script>');