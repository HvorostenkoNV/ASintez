<?
/** **********************************************************************
 * @var array $arParams
 * @var array $arResult
 ************************************************************************/
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();
if( count($arResult['SOCSERV']) <= 0 ) return;
/** **********************************************************************
 ********************** calc fontawesome icon class **********************
 ************************************************************************/
foreach( $arResult['SOCSERV'] as $type => $item )
{
	$iconClass = '';

	switch( $type )
	{
		case 'GOOGLE':      $iconClass = 'fab fa-google-plus-g';    break;
		case 'TWITTER':     $iconClass = 'fab fa-twitter';          break;
		case 'FACEBOOK':    $iconClass = 'fab fa-facebook-f';       break;
	}

	if( strlen($iconClass) > 0 )
		$arResult['SOCSERV'][$type]['icon_class'] = $iconClass;
}
/** **********************************************************************
 ********************************* output ********************************
 ************************************************************************/
?>
<?foreach( $arResult['SOCSERV'] as $item ):?>
    <?if( strlen($item['icon_class']) > 0 ):?>
    <a
        class="alfasintez-socnet-link"
        href="<?=$item['LINK']?>"
        target="_blank"
        rel="nofollow"
    >
        <i class="<?=$item['icon_class']?>"></i>
    </a>
    <?endif?>
<?endforeach?>