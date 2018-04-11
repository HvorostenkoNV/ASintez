<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Iblock\Component\Tools;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 *************************** process need page ***************************
 ************************************************************************/
switch( $arResult['PAGE_TYPE'] )
{
	/** *********************************************
	 ***************** catalog page *****************
	 ***********************************************/
	case 'catalog':
		$APPLICATION->AddChainItem
		(
			$arParams['CHAIN_TITLE'],
			$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['sections']
		);

		include 'catalog.php';
		break;
	/** *********************************************
	 ***************** section page *****************
	 ***********************************************/
	case 'section':
		$APPLICATION->AddChainItem
		(
			$arParams['CHAIN_TITLE'],
			$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['sections']
		);

		if( $arParams['ADD_SECTIONS_CHAIN'] == 'Y' )
		{
			foreach( $arResult['SECTIONS_CHAIN'] as $item )
				$APPLICATION->AddChainItem
				(
					$item['NAME'],
					str_replace
					(
						['#SECTION_ID#',    '#SECTION_CODE#'],
						[$item['ID'],       $item['CODE']],
						$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['section']
					)
				);

			$APPLICATION->AddChainItem
			(
				$arResult['VARIABLES']['SECTION_NAME'],
				str_replace
				(
					['#SECTION_ID#',                        '#SECTION_CODE#'],
					[$arResult['VARIABLES']['SECTION_ID'],  $arResult['VARIABLES']['SECTION_CODE']],
					$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['section']
				)
			);
		}

		if( $arParams['SET_TITLE'] == 'Y' )
			$APPLICATION->SetTitle($arResult['VARIABLES']['SECTION_NAME']);

		include 'section.php';
		break;
	/** *********************************************
	 ****************** item page *******************
	 ***********************************************/
	case 'item':
		$APPLICATION->AddChainItem
		(
			$arParams['CHAIN_TITLE'],
			$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['sections']
		);


		if( $arParams['ADD_SECTIONS_CHAIN'] == 'Y' )
		{
			foreach( $arResult['SECTIONS_CHAIN'] as $item )
				$APPLICATION->AddChainItem
				(
					$item['NAME'],
					str_replace
					(
						['#SECTION_ID#',    '#SECTION_CODE#'],
						[$item['ID'],       $item['CODE']],
						$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['section']
					)
				);

			$APPLICATION->AddChainItem
			(
				$arResult['VARIABLES']['ELEMENT_NAME'],
				str_replace
				(
					['#SECTION_ID#',                        '#SECTION_CODE#'],
					[$arResult['VARIABLES']['ELEMENT_ID'],  $arResult['VARIABLES']['ELEMENT_CODE']],
					$arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['section']
				)
			);
		}

		if( $arParams['SET_TITLE'] == 'Y' )
			$APPLICATION->SetTitle($arResult['VARIABLES']['ELEMENT_NAME']);

		include 'element.php';
		break;
	/** *********************************************
	 ********************** 404 *********************
	 ***********************************************/
	default:
		Tools::process404('', true, true, true);
		break;
}