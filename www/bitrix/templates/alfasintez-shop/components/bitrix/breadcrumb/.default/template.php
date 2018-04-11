<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use
	Bitrix\Main\Application,
	Bitrix\Main\Web\Uri;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult) <=0 )                                        return;
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$context            = Application::getInstance()->getContext();
$server             = $context->getServer();
$request            = $context->getRequest();
$uri                = new Uri($request->getRequestUri());

$itemsCount         = count($arResult);
$outputBreadcrumbs  = '';
$outputMicrodata    = '';
/** **********************************************************************
 ********************************** calc *********************************
 ************************************************************************/
foreach( $arResult as $index => $item )
{
	$link = strlen($item['LINK']) > 0 ? $item['LINK'] : $uri->getPath();
	$arResult[$index]['FULL_LINK'] = CURRENT_PROTOCOL.'://'.$server->getServerName().$link;
	$arResult[$index]['LAST_ITEM'] = $index == $itemsCount - 1;
}
/** **********************************************************************
 ****************************** breadcrumbs ******************************
 ************************************************************************/
foreach( $arResult as $index => $item )
{
	$outputBreadcrumbs .= '
		<a
			href="'.$item['LINK'].'"
			title="'.$item['TITLE'].'"
			'.($item['LAST_ITEM'] ? 'rel="nofollow"' : '').'
		>
			'.$item['TITLE'].'
		</a>';

	if( !$item['LAST_ITEM'] )
		$outputBreadcrumbs .= '<i class="fas fa-angle-right"></i>';
}
/** **********************************************************************
 ******************************* microdata *******************************
 ************************************************************************/
foreach( $arResult as $index => $item )
	$outputMicrodata .= '
		<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
			<span itemprop="position" content="'.($index + 1).'" /></span>
			<span itemprop="name"     content="'.$item['TITLE'].'" /></span>
			<span itemprop="url"      content="'.$server->getServerName().$item['LINK'].'" /></span>
		</span>';
/** **********************************************************************
 ****************************** breadcrumbs ******************************
 ************************************************************************/
return
	$outputBreadcrumbs.'
	<div itemscope itemprop="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
		'.$outputMicrodata.'
	</div>';