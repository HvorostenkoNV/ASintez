<?
/** **********************************************************************
 * @var CMain $APPLICATION
 ************************************************************************/
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$componentParams    = array_key_exists('component-params',  $_POST) ? unserialize(base64_decode($_POST['component-params']))    : [];
$offers             = array_key_exists('offers',            $_POST) ? $_POST['offers']                                          : [];
$filterName         = 'CATALOG_SECTION_WITH_OFFERS_FILTER_AJAX';

if( !is_array($componentParams) )   $componentParams    = [];
if( !is_array($offers) )            $offers             = [];
/** **********************************************************************
 **************************** output component ***************************
 ************************************************************************/
$GLOBALS[$filterName] = ['ID' => count($offers) > 0 ? $offers : 'NONE'];
$componentParams['FILTER_NAME'] = $filterName;
$componentParams['CACHE_TYPE']  = 'N';

$APPLICATION->IncludeComponent('bitrix:catalog.section', '', $componentParams);