<?
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

$arResult['FIELDS'] = [];
if( count($arResult['QUESTIONS']) > 0 )
	foreach( $arResult['QUESTIONS'] as $fieldCode => $question )
	{
		if( array_key_exists(0, $question['STRUCTURE']) && $question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' )
			$arResult['FORM_HEADER'] .= $question['HTML_CODE'];
		else
			foreach( $question['STRUCTURE'] as $field )
			{
				$listTypeProp = in_array($field['FIELD_TYPE'], ['radio', 'dropdown', 'checkbox', 'multiselect']);

				if( !$arResult['FIELDS'][$fieldCode] )
				{
					$inputName = $listTypeProp ? 'form_'.$field['FIELD_TYPE'].'_'.$fieldCode : 'form_'.$field['FIELD_TYPE'].'_'.$field['ID'];
					$inputType = $field['FIELD_TYPE'];

					if( in_array($fieldCode, ['phone', 'contact_phone']) )
						$inputType = 'phone';

					$arResult['FIELDS'][$fieldCode] =
					[
						'NAME'       => $inputName,
						'TYPE'       => $inputType,
						'VALUE'      => $arResult['arrVALUES'][$inputName],
						'TITLE'      => $question['CAPTION'],
						'REQUIRED'   => $question['REQUIRED'],
						'VALIDATORS' => CFormValidator::GetList($field['FIELD_ID'], [], $by = 'SORT', $order = 'ASC')->arResult
					];
				}

				if( $listTypeProp )
					$arResult['FIELDS'][$fieldCode]['LIST'][$field['ID']] = $field['MESSAGE'];
			}
	}