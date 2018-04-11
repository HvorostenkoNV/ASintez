<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 ************************************************************************/
use
	Bitrix\Main\Application,
	Bitrix\Main\Entity\Query,
	Bitrix\Iblock\SectionTable,
	Bitrix\Iblock\ElementTable;

if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['CATEGORIES']) <= 0 ) return;
/** **********************************************************************
 ******************************* variables *******************************
 ************************************************************************/
$server                 = Application::getInstance()->getContext()->getServer();
$categories             = [];
$allResultsLink         = '';
$allResultsTitle        = '';
$defaultImagePath       = $server->getDocumentRoot().$this->GetFolder().'/images/default_image.svg';
$defaultImageContent    = file_get_contents($defaultImagePath);
$itemsImages            =
[
	'item'      => [],
	'section'   => []
];
/** **********************************************************************
 **************************** read categories ****************************
 ************************************************************************/
foreach( $arResult['CATEGORIES'] as $categoryIndex => $category )
{
	if( !is_array($category['ITEMS']) || count($category['ITEMS']) <= 0 )
		continue;

	if( $categoryIndex == 'all' )
	{
		$allResultsLink     = str_replace('index.php', '', $category['ITEMS'][0]['URL']);
		$allResultsTitle    = strip_tags($category['ITEMS'][0]['NAME']);
		continue;
	}

	$categories[$categoryIndex] = ['ITEMS' => []];

	foreach( $category['ITEMS'] as $item )
		if( strlen($item['PARAM1']) > 0 || strlen($item['PARAM2']) > 0 )
		{
			$url        = str_replace('index.php', '', $item['URL']);
			$title      = strip_tags($item['NAME']);
			$itemId     = 0;
			$itemType   = '';

			if( array_key_exists('ITEM_ID', $item) )
			{
				$itemId     = (int) str_replace('S', '', $item['ITEM_ID']);
				$itemType   = strpos($item['ITEM_ID'], 'S') !== false
					? 'section'
					: 'item';

				$itemsImages[$itemType][$itemId] = NULL;
			}

			$categories[$categoryIndex]['ITEMS'][] =
			[
				'LINK'      => $url,
				'TITLE'     => $title,
				'ITEM_ID'   => $itemId,
				'ITEM_TYPE' => $itemType,
				'IMAGE'     => ''
			];
		}
}
/** **********************************************************************
 ***************************** images query ******************************
 ************************************************************************/
if( count($itemsImages['item']) > 0 )
{
	$query = new Query(ElementTable::getEntity());
	$query->setSelect(['ID', 'PREVIEW_PICTURE']);
	$query->setFilter(['ID' => array_keys($itemsImages['item'])]);

	foreach( $query->exec()->fetchAll() as $item )
		$itemsImages['item'][$item['ID']] = CFile::GetPath($item['PREVIEW_PICTURE']);
}
if( count($itemsImages['section']) > 0 )
{
	$query = new Query(SectionTable::getEntity());
	$query->setSelect(['ID', 'PICTURE']);
	$query->setFilter(['ID' => array_keys($itemsImages['item'])]);

	foreach( $query->exec()->fetchAll() as $item )
		$itemsImages['section'][$item['ID']] = CFile::GetPath($item['PICTURE']);
}
/** **********************************************************************
 ************************ fill items with images *************************
 ************************************************************************/
foreach( $categories as $categoryIndex => $category )
	foreach( $category['ITEMS'] as $itemIndex => $item )
		if( $item['ITEM_ID'] > 0 )
			$categories[$categoryIndex]['ITEMS'][$itemIndex]['IMAGE'] = $itemsImages[$item['ITEM_TYPE']][$item['ITEM_ID']];
/** **********************************************************************
 **************************** update arResult ****************************
 ************************************************************************/
$arResult['CATEGORIES']             = $categories;
$arResult['ALL_RESULTS_LINK']       = $allResultsLink;
$arResult['ALL_RESULTS_TITLE']      = $allResultsTitle;
$arResult['DEFAULT_IMAGE_CONTENT']  = $defaultImageContent;
/** **********************************************************************
 ******************************** output *********************************
 ************************************************************************/
?>
<?foreach( $arResult['CATEGORIES'] as $category ):?>
	<?foreach( $category['ITEMS'] as $item ):?>
	<a class="item" href="<?=$item['LINK']?>" tabindex="-1">
		<?if( strlen($item['IMAGE']) > 0 ):?>
            <div class="image">
                <img
                    src="<?=$item['IMAGE']?>"
                    alt="<?=$item['NAME']?>"
                    title="<?=$item['NAME']?>"
                >
            </div>
        <?else:?>
            <div class="default-image">
                <?=$arResult['DEFAULT_IMAGE_CONTENT']?>
            </div>
		<?endif?>

		<div class="title">
			<?=$item['TITLE']?>
		</div>
	</a>
	<?endforeach?>
<?endforeach?>

<?if( strlen($arResult['ALL_RESULTS_LINK']) > 0 ):?>
<a class="all-results" href="<?=$arResult['ALL_RESULTS_LINK']?>" tabindex="-1">
    <?=$arResult['ALL_RESULTS_TITLE']?>
</a>
<?endif?>