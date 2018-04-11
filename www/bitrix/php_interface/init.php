<?
/** **********************************************************************
 ******************************* constants *******************************
 ************************************************************************/
define('CURRENT_PROTOCOL',  $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http');
define('BITRIX_ROOT',       '/home/bitrix/www');
/** **********************************************************************
 ******************************* includings ******************************
 ************************************************************************/
include 'js_libraries_registration.php';
include 'functions.php';
/** **********************************************************************
 *************************** classes autoloader **************************
 ************************************************************************/
CModule::AddAutoloadClasses
(
	'',
	[
		'AvComponentsIncludings'                           => '/bitrix/php_interface/av_classes/components_includings/AvComponentsIncludings.php',
		'Av\\ImageProcessing\\Watermarks\\WatermarkAdding' => '/bitrix/php_interface/av_classes/image_processing/watermarks/WatermarkAdding.php'
	]
);