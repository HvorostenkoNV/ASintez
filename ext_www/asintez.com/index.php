<?
/** **********************************************************************
 * @var CMain $APPLICATION
 ************************************************************************/
use Bitrix\Main\Page\Asset;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

$APPLICATION->SetTitle       ('');
$APPLICATION->SetPageProperty('title',       '');
$APPLICATION->SetPageProperty('description', '');

Asset::getInstance()->addCss('/bitrix/css/alfasintez-shop/index.css');
Asset::getInstance()->addCss('/bitrix/css/alfasintez-shop/slick-slider-styles/slick.css');
Asset::getInstance()->addJs ('/bitrix/js/alfasintez-shop/index.js');
Asset::getInstance()->addJs ('https://maps.googleapis.com/maps/api/js?key=AIzaSyA46WZQVEJSS2zf5hZPQW3-oV6P5RSCUDQ&callback=initMap');
Asset::getInstance()->addJs ('/bitrix/js/alfasintez-shop//slick-slider/slick.min.js');
/** **********************************************************************
 ********************************** page *********************************
 ************************************************************************/
?>
<div id="main-page">
	<?
	/** **********************************************************************
	 ******************************** about us *******************************
	 ************************************************************************/
	?>
    <div class="about-us page-responsive-block">
        <div class="page-block-title">
            <h2 class="title">Немного о нас</h2>
            <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
        </div>

        <div class="about-inner">
            <div class="about-half-side">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. pariatur.</p>
            </div>
            <div class="about-half-side">
                <div class="about-eggs-slide-lines">
                    <div class="about-line-animate first-top-line">
                        <span class="about-eggs-txt">Экологически<br> чистый продукт</span>
                    </div>
                </div>
                <div class="about-eggs-slide-lines">
                    <div class="about-line-animate second-top-line">
                        <span class="about-eggs-txt">Европейское<br> оборудование</span>
                    </div>
                </div>
                <div class="about-eggs-slide-lines">
                    <div class="about-line-animate first-bottom-line">
                        <span class="about-eggs-txt">Удобство в использовании</span>
                    </div>
                </div>
                <div class="about-eggs-slide-lines">
                    <div class="about-line-animate second-bottom-line">
                        <span class="about-eggs-txt">Прочность материала</span>
                    </div>
                </div>
                <img src="/bitrix/images/alfasintez-shop/index/about/about-eggs.png" alt="">
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ********************************* slides ********************************
	 ************************************************************************/
	?>
    <div class="slides">
        <div class="slides-inner slide-left">
            <img src="/bitrix/images/alfasintez-shop/index/about/package-1.jpg" alt="">
            <div class="slide-text-box">
                <span>Упаковка<br> для продуктов питания</span>
                <button class="slide-btn">Узнать больше</button>
            </div>
        </div>
        <div class="slides-inner slide-right">
            <img src="/bitrix/images/alfasintez-shop/index/about/package-2.jpg" alt="">
            <div class="slide-text-box">
                <span>Пленка PET</span>
                <button class="slide-btn">Узнать больше</button>
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ******************************** products *******************************
	 ************************************************************************/
	?>
    <div class="products page-responsive-block">
        <div class="page-block-title">
            <h2 class="title">Продукция</h2>
            <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
        </div>
        <div class="list">
            <?$APPLICATION->IncludeComponent
            (
	            'bitrix:catalog', 'preview',
	            array(
		            'IBLOCK_TYPE'               => 'catalog_asintez',
		            'IBLOCK_ID'                 => 8,
		            'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',

		            'SEF_MODE'          => 'Y',
		            'SEF_FOLDER'        => '',
		            'SEF_URL_TEMPLATES' =>
                    array(
                        'sections'  => '/catalog/',
                        'section'   => '/#SECTION_CODE#/',
                        'element'   => '/#ELEMENT_CODE#/',
                    ),

		            'CACHE_TYPE'    => 'A',
		            'CACHE_TIME'    => 36000000,
		            'CACHE_FILTER'  => 'Y',
		            'CACHE_GROUPS'  => 'Y',

		            'PRICE_CODE'        => array('BASE'),
		            'PRICE_VAT_INCLUDE' => 'Y',
		            'CONVERT_CURRENCY'  => 'Y',
		            'CURRENCY_ID'       => 'UAH',

		            'INCLUDE_SUBSECTIONS'       => 'Y',
		            'LIST_OFFERS_FIELD_CODE'    => array('NAME', 'PREVIEW_PICTURE'),
		            'PAGE_ELEMENT_COUNT'        => 99,

		            'OFFERS_SORT_FIELD'     => 'sort',
		            'OFFERS_SORT_ORDER'     => 'asc',
		            'OFFERS_SORT_FIELD2'    => 'id',
		            'OFFERS_SORT_ORDER2'    => 'desc',

		            'SET_TITLE' => 'Y'
	            )
            );?>
        </div>
    </div>
	<?
	/** **********************************************************************
	 *************************** cooperate with us ***************************
	 ************************************************************************/
	?>
    <div class="cooperate-with-us has-wave-frame-top has-wave-frame-bottom">
        <div class="page-block-title title-white">
            <h2 class="title">C нами сотрудничают</h2>
        </div>
        <div class="cooperate-with-us-inner page-responsive-block">
            <div class="cooperate-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/partners/chicken.svg" alt="">
                <span class="corporate-txt">птицефабрики</span>
            </div>
            <div class="cooperate-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/partners/ranch.svg" alt="">
                <span class="corporate-txt">фермерские хозяйства</span>
            </div>
            <div class="cooperate-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/partners/meet.svg" alt="">
                <span class="corporate-txt">мясокомбинаты</span>
            </div>
            <div class="cooperate-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/partners/cupcakes.svg" alt="">
                <span class="corporate-txt">продуктовые сети</span>
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 *************************** production cycle ****************************
	 ************************************************************************/
	?>
    <div class="production-cycle">
        <div class="page-block-title">
            <h2 class="title">Полный цикл производства</h2>
            <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
        </div>
        <div class="production-wrapper page-responsive-block">
            <div class="production-inner">
                <figure>
                    <img src="/bitrix/images/alfasintez-shop/index/production/waters.jpg" alt="">
                </figure>
                <figcaption>
                    <h3>Производство флекс крошки</h3>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcaption>
            </div>
            <div class="production-inner">
                <figure>
                    <img src="/bitrix/images/alfasintez-shop/index/production/granules.jpg" alt="">
                </figure>
                <figcaption>
                    <h3>Производство Флекс гранул</h3>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcaption>
            </div>
            <div class="production-inner">
                <figure>
                    <img src="/bitrix/images/alfasintez-shop/index/production/husk.jpg" alt="">
                </figure>
                <figcaption>
                    <h3>Производство PET пленки</h3>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcaption>
            </div>
            <div class="production-inner">
                <figure>
                    <img src="/bitrix/images/alfasintez-shop/index/production/pack.jpg" alt="">
                </figure>
                <figcaption>
                    <h3>Производство упаковки</h3>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcaption>
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ****************************** text slider ******************************
	 ************************************************************************/
	?>
    <div class="text-slider">
        <div class="text-slider-inner text-slide-1">
            <div class="slider-info">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Praesent lobortis lectus eget libero blandit venenatis.In blandit tortor vel congue malesuada. Suspendisse molestie lobortis lorem dignissim pretium.</p>
                </blockquote>
                <cite>John Doe<br>from some company</cite>
            </div>
        </div>
        <div class="text-slider-inner text-slide-2">
            <div class="slider-info">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Praesent lobortis lectus eget libero blandit venenatis.In blandit tortor vel congue malesuada. Suspendisse molestie lobortis lorem dignissim pretium.</p>
                </blockquote>
                <cite>John Doe<br>from some company</cite>
            </div>
        </div>
        <div class="text-slider-inner text-slide-3">
            <div class="slider-info">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Praesent lobortis lectus eget libero blandit venenatis.In blandit tortor vel congue malesuada. Suspendisse molestie lobortis lorem dignissim pretium.</p>
                </blockquote>
                <cite>John Doe<br>from some company</cite>
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ******************************** why we *********************************
	 ************************************************************************/
	?>
    <div class="why-we page-responsive-block">
        <div class="why-we-left">

        </div>
        <div class="why-we-right">
            <div class="page-block-title">
                <h2 class="title">почему стоит доверять нам</h2>
                <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
            </div>
            <div class="why-we-txt">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum...</p>
            </div>
            <?
            $APPLICATION->IncludeComponent
            (
                'alfasintez:form.button', 'alt',
                [
                    'BUTTON_TYPE' => 'link',
                    'LINK' => '/about/',
                    'TITLE'       => 'УЗНАТЬ БОЛЬШЕ'
                ],
                false, ['HIDE_ICONS' => 'Y']
            );
            ?>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ***************************** certificates ******************************
	 ************************************************************************/
	?>
    <div class="certificates has-wave-frame-top has-wave-frame-bottom">
        <div class="page-block-title title-white">
            <h2 class="title">Наши сертификаты</h2>
        </div>
        <div class="certificates-inner page-responsive-block">
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/ce.svg" alt="">
            </div>
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/usm.svg" alt="">
            </div>
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/hassp.svg" alt="">
            </div>
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/iso-circle.svg" alt="">
            </div>
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/es.svg" alt="">
            </div>
            <div class="certificates-inner-box">
                <img src="/bitrix/images/alfasintez-shop/index/certificates/iso.svg" alt="">
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ********************************* news **********************************
	 ************************************************************************/
	?>
    <div class="news">
        <div class="page-block-title">
            <h2 class="title">Новости нашей компании</h2>
            <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
        </div>
        <div class="news-wrapper page-responsive-block">
            <div class="news-inner">
                <figure>
                    <img src="" alt="">
                    <span>screen shot#1</span>
                </figure>
                <figcapture>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcapture>
            </div>
            <div class="news-inner">
                <figure>
                    <img src="" alt="">
                    <span>screen shot#2</span>
                </figure>
                <figcapture>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcapture>
            </div>
            <div class="news-inner">
                <figure>
                    <img src="" alt="">
                    <span>screen shot#3</span>
                </figure>
                <figcapture>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcapture>
            </div>
            <div class="news-inner">
                <figure>
                    <img src="" alt="">
                    <span>screen shot#4</span>
                </figure>
                <figcapture>
                    <span class="under-pict-txt">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam elerisque mi id faucibus iaculis vitae pulvinar.</span>
                </figcapture>
            </div>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ************************ products subcategories *************************
	 ************************************************************************/
	?>
    <div class="products-subcategories">
        <div class="page-block-title">
            <h2 class="title">подкатегории продукции</h2>
            <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
        </div>
        <div class="products-subcategories-wrapper page-responsive-block">
            <ul class="products-subcategories-list">
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для рыбы</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для мяса</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для овощей</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
            </ul>
            <ul class="products-subcategories-list">
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для рыбы</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для мяса</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для овощей</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
            </ul>
            <ul class="products-subcategories-list">
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для рыбы</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для мяса</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для овощей</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
            </ul>
            <ul class="products-subcategories-list">
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для рыбы</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для мяса</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для овощей</span></li>
                <li><i class="far fa-check-circle"></i><span>Упаковка для фруктов</span></li>
            </ul>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ******************************** seo-text *******************************
	 ************************************************************************/
	?>
    <div class="seo-text">
        <div class="products-subcategories-under-wrap">
            <span class="products-subcategories-under">Очень важный текст для сео</span>
            <span class="products-subcategories-more"><i class="fas fa-plus"></i></span>
        </div>
        <div class="seo-txt-inner">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolorum id ipsum laboriosam necessitatibus pariatur porro quisquam rem sed sequi sit, sunt vero voluptatibus. Atque cum ipsum nostrum quidem vitae!</p>
        </div>
    </div>
	<?
	/** **********************************************************************
	 ******************************** contacts *******************************
	 ************************************************************************/
	?>
    <div class="contacts">
        <div class="map-left-side">
            <div class="map-left-side-list">
                <div class="page-block-title title-white">
                    <h2 class="title">контакты</h2>
                    <span class="text">Daisy is sagittis sem nibh id elit</span>
                </div>

                <ul class="map-list">
                    <li><i class="fas fa-phone"></i><span>8 800 555 23 54</span></li>
                    <li><i class="fas fa-envelope"></i><span>yudinanatasha@mail.ru</span></li>
                    <li><i class="fas fa-envelope"></i><span>viktorkomteka@mail.ru</span></li>
                    <li><i class="fas fa-map-marker-alt"></i><span>ул. Карла Маркса д.2 оф.15</span></li>
                </ul>
                <?
                $APPLICATION->IncludeComponent
                (
                    'alfasintez:form.button', '',
                    [
                        'BUTTON_TYPE' => 'label',
                        'TITLE'       => 'ЗАКАЗАТЬ ЗВОНОК'
                    ],
                    false, ['HIDE_ICONS' => 'Y']
                );
                ?>
            </div>
            <div id="van_map_img" class="van_animation"></div>
        </div>
        <div id="map_canvas"></div>
    </div>
</div>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>