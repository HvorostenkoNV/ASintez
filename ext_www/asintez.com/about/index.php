<?
use Bitrix\Main\Page\Asset;

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle       ('');
$APPLICATION->SetPageProperty('title',       '');
$APPLICATION->SetPageProperty('description', '');

Asset::getInstance()->addCss('/bitrix/css/alfasintez-shop/about.css');
Asset::getInstance()->addCss('/bitrix/css/alfasintez-shop/slick-slider-styles/slick.css');
Asset::getInstance()->addJs ('/bitrix/js/alfasintez-shop/about.js');
Asset::getInstance()->addJs ('https://maps.googleapis.com/maps/api/js?key=AIzaSyA46WZQVEJSS2zf5hZPQW3-oV6P5RSCUDQ&callback=initMap');
Asset::getInstance()->addJs ('/bitrix/js/alfasintez-shop//slick-slider/slick.min.js');
?>
<div id="about-page">
    <?
    /** **********************************************************************
     ***************************** about ******************************
     ************************************************************************/
    ?>
    <div class="about-box page-responsive-block">
        <div class="about-box-inner">
            <div class="page-block-title">
                <h1 class="title">Немного о нас</h1>
                <span class="text">Daisy is sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</span>
            </div>
            <div class="about-box-left">
                <p class="main-page-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <p class="main-page-txt">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
            </div>
        </div>
        <div class="about-box-right">
            <figure>
                <img src="/bitrix/images/alfasintez-shop/index/about/women.png" alt="">
            </figure>
            <figcaption>
                <cite>генеральный директор</cite>
                <blockquote>“мы делаем украинский продукт европейского качества”</blockquote>
            </figcaption>
        </div>
    </div>

    <?
    /** **********************************************************************
     ***************************** certificates ******************************
     ************************************************************************/
    ?>
    <div class="certificates has-wave-frame-top has-wave-frame-bottom">
        <div class="page-responsive-block">
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
    </div>
    <?
    /** **********************************************************************
     *************************** production cycle ****************************
     ************************************************************************/
    ?>
    <div class="production-cycle page-responsive-block">
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
     ******************************** slider *********************************
     ************************************************************************/
    ?>
    <div class="about-slider">
        <div>
            <img src="/bitrix/images/alfasintez-shop/about/slider/slide-1.png" alt="">
        </div>
        <div>
            <img src="/bitrix/images/alfasintez-shop/about/slider/slide-1.png" alt="">
        </div>
        <div>
            <img src="/bitrix/images/alfasintez-shop/about/slider/slide-1.png" alt="">
        </div>
    </div>
    <?
    /** **********************************************************************
     **************************** why we use rPAT ****************************
     ************************************************************************/
    ?>
    <div class="why-we-use page-responsive-block">
        <div class="why-we-use-left">
            <div class="why-we-use-half-side">
                <div class="tomatoes-slide-lines">
                    <div class="tomatoes-line-animate first-top-line">
                        <span class="tomatoes-txt">Экологически<br> чистый продукт</span>
                    </div>
                </div>
                <div class="tomatoes-slide-lines">
                    <div class="tomatoes-line-animate second-top-line">
                        <span class="tomatoes-txt">Европейское<br> оборудование</span>
                    </div>
                </div>
                <div class="tomatoes-slide-lines">
                    <div class="tomatoes-line-animate first-bottom-line">
                        <span class="tomatoes-txt">Прочность материала</span>
                    </div>
                </div>
                <div class="tomatoes-slide-lines">
                    <div class="tomatoes-line-animate second-bottom-line">
                        <span class="tomatoes-txt">Удобство в использовании</span>
                    </div>
                </div>
                <img src="/bitrix/images/alfasintez-shop/about/why-we-use/tomatoes.png" alt="">
            </div>
        </div>
        <div class="why-we-use-right">
            <div class="page-block-title">
                <h2 class="title">Почему мы выбираем <span>r</span>pat</h2>
            </div>
            <div class="why-we-use-txt">
                <p class="main-page-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
                <p class="main-page-txt">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
            </div>
        </div>
    </div>
    <?
    /** **********************************************************************
     ***************************** order points ******************************
     ************************************************************************/
    ?>
    <div class="order-point">
        <div class="order-inner page-responsive-block">
            <div class="order-point-data">
                <div class="order-num-wrap">
                    <span>28</span>
                    <span class="order-point-measure">тыс.</span>
                </div>
                <span>выполненных заказов</span>
            </div>
            <div class="order-point-data">
                <div class="order-num-wrap">
                    <span>54</span>
                    <span class="order-point-measure">тон.</span>
                </div>
                <span>изготовленной пленки</span>
            </div>
            <div class="order-point-data">
                <div class="order-num-wrap">
                    <span>20</span>
                </div>
                <span>лет работы</span>
            </div>
            <div class="order-point-data">
                <div class="order-num-wrap">
                    <span>11</span>
                </div>
                <span>стран партнеров</span>
            </div>
            <div class="order-point-data">
                <div class="order-num-wrap">
                    <span>289</span>
                    <span class="order-point-measure">млн.</span>
                </div>
                <span>продано упаковок</span>
            </div>
        </div>
    </div>
    <?
    /** **********************************************************************
     ************************* pay & delivery order **************************
     ************************************************************************/
    ?>
    <div class="delivery-order page-responsive-block">
        <div class="delivery-inner">
            <div class="delivery-make">
                <img src="/bitrix/images/alfasintez-shop/about/delivery/delivery-car.png" alt="">
                <span>доставка заказа</span>
            </div>
            <div class="delivery-list">
                <ul>
                    <li><i class="fas fa-check"></i><span>Новая почта</span></li>
                    <li><i class="fas fa-check"></i><span>Ин-Тайм</span></li>
                    <li><i class="fas fa-check"></i><span>Delivery</span></li>
                    <li><i class="fas fa-check"></i><span>Ночной экспресс</span></li>
                    <li><i class="fas fa-check"></i><span>САТ</span></li>
                </ul>
            </div>
        </div>
        <div class="delivery-inner">
            <div class="delivery-make">
                <img src="/bitrix/images/alfasintez-shop/about/delivery/delivery-pay.png" alt="">
                <span>оплата</span>
            </div>
            <div class="delivery-list">
                <ul>
                    <li><i class="fas fa-check"></i><span>Безналичный расчет</span></li>
                </ul>
            </div>
        </div>
        <div class="delivery-inner">
            <div class="delivery-make">
                <img src="/bitrix/images/alfasintez-shop/about/delivery/delivery-reward.png" alt="">
                <span>почему мы?</span>
            </div>
            <div class="delivery-list">
                <ul>
                    <li><i class="fas fa-check"></i><span>Европейское качество</span></li>
                    <li><i class="fas fa-check"></i><span>Наличие сертификатов</span></li>
                    <li><i class="fas fa-check"></i><span>Удобный дизайн упаковок</span></li>
                    <li><i class="fas fa-check"></i><span>Нанесение этикеток</span></li>
                    <li><i class="fas fa-check"></i><span>Экологическое сырье</span></li>
                </ul>
            </div>
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
        <div id="about_map_canvas"></div>
    </div>
</div>
<?require $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'?>