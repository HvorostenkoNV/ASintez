<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['ITEMS']) <= 0 ) return;
/** **********************************************************************
 ********************************* filter ********************************
 ************************************************************************/
?>
<form
	class="alfasintez-smart-filter"
	name="<?=$arResult['FILTER_NAME']?>_form"
	action="<?=$arResult['FORM_ACTION']?>"
	method="get"
    data-iblock-id="<?=$arParams['IBLOCK_ID']?>"
    data-offers-iblock-id="<?=$arParams['OFFERS_IBLOCK_ID']?>"
    data-section-id="<?=$arResult['SECTION_ID']?>"
    data-filter-url="<?=$arResult['APPLIED_FILTER_URL_TEMPLATE']?>"
    data-clear-filter-url="<?=$arResult['SEF_DEL_FILTER_URL']?>"
    data-filter-name="<?=$arResult['FILTER_NAME']?>"
>
    <?
    /** *********************************************
     ***************** hidden fields ****************
     ***********************************************/
    ?>
	<?foreach( $arResult['HIDDEN'] as $item ):?>
	<input
        type="hidden"
        name="<?=$item['CONTROL_NAME']?>"
        id="<?=$item['CONTROL_ID']?>"
        value="<?=$item['HTML_VALUE']?>"
    >
	<?endforeach?>
	<?
	/** *********************************************
	 ******************** fields ********************
	 ***********************************************/
	?>
	<?foreach( $arResult['ITEMS'] as $item ):?>
    <div class="
        field-block
        <?if( $item['APPLIED'] ):?>applied<?endif?>
        <?if( $item['DISPLAY_EXPANDED'] == 'Y' ):?>expanded<?endif?>
        "
    >
        <div class="head">
            <div class="title">
                <?=$item['NAME']?>
            </div>
            <div class="open-button" tabindex="0">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <ul class="body">
            <?
            /** ******************************
             ********** checkboxes ***********
             ********************************/
            ?>
            <?if( $item['DISPLAY_TYPE'] == 'F' ):?>
	            <?foreach( $item['VALUES'] as $listItem ):?>
                <li>
                    <?
                    $APPLICATION->IncludeComponent
                    (
	                    'alfasintez:form.checkbox', '',
	                    [
		                    'NAME'      => $listItem['CONTROL_NAME'],
		                    'VALUE'     => 'Y',
		                    'TITLE'     => $listItem['VALUE'],
		                    'CHECKED'   => $listItem['CHECKED']
	                    ],
	                    false, ['HIDE_ICONS' => 'Y']
                    );
                    ?>
                </li>
	            <?endforeach?>
            <?
            /** ******************************
             ********** radio list ***********
             ********************************/
            ?>
            <?else:?>
                <li>
		            <?
		            $APPLICATION->IncludeComponent
		            (
			            'alfasintez:form.checkbox', 'radio',
			            [
				            'NAME'      => $item['INPUT_NAME'],
				            'VALUE'     => '',
				            'TITLE'     => Loc::getMessage('ALFASINTEZ_CATALOG_SMART_FILTER_ITEMS_ALL_TITLE'),
				            'CHECKED'   => !$item['APPLIED']
			            ],
			            false, ['HIDE_ICONS' => 'Y']
		            );
		            ?>
                </li>
	            <?foreach( $item['VALUES'] as $listItem ):?>
                <li>
                    <?
                    $APPLICATION->IncludeComponent
                    (
                        'alfasintez:form.checkbox', 'radio',
                        [
	                        'NAME'      => $listItem['CONTROL_NAME_ALT'],
	                        'VALUE'     => $listItem['HTML_VALUE_ALT'],
	                        'TITLE'     => $listItem['VALUE'],
	                        'CHECKED'   => $listItem['CHECKED']
                        ],
                        false, ['HIDE_ICONS' => 'Y']
                    );
                    ?>
                </li>
	            <?endforeach?>
            <?endif?>
        </ul>
    </div>
	<?endforeach?>
</form>