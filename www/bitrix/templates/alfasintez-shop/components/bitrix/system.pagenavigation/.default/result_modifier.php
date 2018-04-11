<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$currentPage        = (int) $arResult['NavPageNomer'];
$pagesCount         = (int) $arResult['NavPageCount'];
$baseUrl            = $arResult['sUrlPath'];
$pageUrlTemplate    = $arResult['sUrlPath'];
$hasUrlVariables    = strlen($arResult['NavQueryString']) > 0;

if( $hasUrlVariables )
	$baseUrl .= '?'.$arResult['NavQueryString'];

$pageUrlTemplate .= $hasUrlVariables ? '&' : '?';
$pageUrlTemplate .= 'PAGEN_'.$arResult['NavNum'].'=';

if( $pagesCount <= 1 ) return;
/** **********************************************************************
 **************************** pages list calc ****************************
 ************************************************************************/
$arResult['PAGES_LIST'] = [];

if( $currentPage > 1 )
	$arResult['PAGES_LIST'][] =
	[
		'TYPE'  => 'SWITCHER-BACK',
		'LINK'  => $pageUrlTemplate.($currentPage - 1)
	];

$arResult['PAGES_LIST'][] =
[
	'TYPE'      => 'PAGE',
	'VALUE'     => 1,
	'LINK'      => $baseUrl,
	'SELECTED'  => $currentPage == 1
];

if( $currentPage >= 5 )
	$arResult['PAGES_LIST'][] =
	[
		'TYPE' => 'SPACE'
	];

foreach( [$currentPage - 2, $currentPage - 1, $currentPage, $currentPage + 1, $currentPage + 2] as $page )
	if( $page >= 2 && $page <= $arResult['NavPageCount'] - 1 )
		$arResult['PAGES_LIST'][] =
		[
			'TYPE'      => 'PAGE',
			'VALUE'     => $page,
			'LINK'      => $pageUrlTemplate.$page,
			'SELECTED'  => $page == $currentPage
		];

if( $currentPage <= $pagesCount - 4 )
	$arResult['PAGES_LIST'][] =
	[
		'TYPE' => 'SPACE'
	];

$arResult['PAGES_LIST'][] =
[
	'TYPE'      => 'PAGE',
	'VALUE'     => $pagesCount,
	'LINK'      => $pageUrlTemplate.$pagesCount,
	'SELECTED'  => $currentPage == $pagesCount
];

if( $currentPage < $pagesCount )
	$arResult['PAGES_LIST'][] =
	[
		'TYPE'  => 'SWITCHER-FORWARD',
		'LINK'  => $pageUrlTemplate.($currentPage + 1)
	];