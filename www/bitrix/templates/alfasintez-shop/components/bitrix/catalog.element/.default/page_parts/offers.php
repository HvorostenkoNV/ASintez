<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
use Bitrix\Main\Localization\Loc;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
/** **********************************************************************
 *************************** offers properties ***************************
 ************************************************************************/
$offersProperties = [];

foreach( $arResult['OFFERS'] as $offer )
	foreach( $offer['PROPERTIES'] as $property )
		$offersProperties[$property['ID']] = $property['NAME'];
/** **********************************************************************
 ****************************** offers table *****************************
 ************************************************************************/
?>
<table>
	<thead>
		<tr>
			<th>
				<?=Loc::getMessage('ALFASINTEZ_CATALOG_ELEMENT_OFFERS_NAME')?>
			</th>
			<?foreach( $offersProperties as $propertyTitle ):?>
			<th>
				<?=$propertyTitle?>
			</th>
			<?endforeach?>
		</tr>
	</thead>
	<tbody>
		<?foreach( $arResult['OFFERS'] as $offer ):?>
		<tr>
			<td>
				<?=$offer['NAME']?>
			</td>
			<?foreach( $offersProperties as $propertyId => $propertyTitle ):?>
			<td>
				<?=strip_tags($offer['PROPERTIES'][$propertyId]['VALUE'])?>
			</td>
			<?endforeach?>
		</tr>
		<?endforeach?>
	</tbody>
</table>