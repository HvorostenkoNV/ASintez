<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use Av\ImageProcessing\Watermarks\WatermarkAdding;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$itemInfo               = $arResult['ITEM'];
$itemPrices             = [];
$imageUrl               = is_array($itemInfo['PREVIEW_PICTURE']) && array_key_exists('UNSAFE_SRC', $itemInfo['PREVIEW_PICTURE'])
	? $itemInfo['PREVIEW_PICTURE']['UNSAFE_SRC']
	: '';
$imageWithWatermarkUrl  = '';
/** **********************************************************************
 ******************************** prices *********************************
 ************************************************************************/
$itemPricesValues = [];

if( count($itemInfo['PRICES']) > 0 )
	foreach( $itemInfo['PRICES'] as $index => $item )
	{
		$price          = $arParams['PRICE_VAT_INCLUDE'] == 'Y' ? $item['DISCOUNT_VALUE_VAT'] : $item['DISCOUNT_VALUE_NOVAT'];
		$priceValue     = (float) SaleFormatCurrency($price, $item['CURRENCY'], true);
		$priceTitle     = SaleFormatCurrency($price, $item['CURRENCY']);
		if( $priceValue <= 0 ) continue;

		$itemPrices[$index] =
		[
			'VALUE' => $priceValue,
			'TITLE' => $priceTitle,
			'MIN'   => false,
			'MAX'   => false
		];
		$itemPricesValues[$index] = $priceValue;
	}

if( count($itemPricesValues) > 0 )
{
	$pricesMin = min($itemPricesValues);
	$pricesMax = max($itemPricesValues);

	$itemPrices[array_search($pricesMin, $itemPricesValues)]['MIN'] = true;
	$itemPrices[array_search($pricesMax, $itemPricesValues)]['MAX'] = true;
}
/** **********************************************************************
 *********************** get image with watermark ************************
 ************************************************************************/
try
{
	$imageWithWatermarkUrl = (new WatermarkAdding($imageUrl))->getImageProcessedUrl();
}
catch( Exception $exception )
{

};
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult = $itemInfo;
$arResult['PRICES_INFO'] = $itemPrices;

if( strlen($imageWithWatermarkUrl) > 0 )
	$arResult['PREVIEW_PICTURE']['SRC'] = $imageWithWatermarkUrl;