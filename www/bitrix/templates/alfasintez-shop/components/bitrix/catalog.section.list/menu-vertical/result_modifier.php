<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['SECTIONS']) <= 0) return;
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$primeSectionId                 = (int) $arResult['SECTIONS'][0]['IBLOCK_SECTION_ID'];
$primeDepthLevel                = (int) $arResult['SECTIONS'][0]['DEPTH_LEVEL'];
$blockIndex                     = 0;
$arResult['SECTIONS_BLOCKS']    = [];
/** **********************************************************************
 **************************** sections blocks ****************************
 ************************************************************************/
foreach( $arResult['SECTIONS'] as $item )
{
	$parentSectionId    = (int) $item['IBLOCK_SECTION_ID'];
	$depthLevel         = (int) $item['DEPTH_LEVEL'];

	if( $parentSectionId == $primeSectionId )
	{
		$blockIndex++;
		$arResult['SECTIONS_BLOCKS'][$blockIndex] =
		[
			'PARENT'    => $item,
			'CHILDREN'  => []
		];
	}
	else
		$arResult['SECTIONS_BLOCKS'][$blockIndex]['CHILDREN'][] = array_merge
		(
			$item,
			['DEPTH_LEVEL' => $depthLevel - $primeDepthLevel]
		);
}