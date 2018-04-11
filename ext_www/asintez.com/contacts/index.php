<?
use Bitrix\Main\Page\Asset;

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle       ('');
$APPLICATION->SetPageProperty('title',       '');
$APPLICATION->SetPageProperty('description', '');

Asset::getInstance()->addCss('/bitrix/css/alfasintez-shop/contacts.css');
Asset::getInstance()->addJs ('/bitrix/js/alfasintez-shop/contacts.js');
Asset::getInstance()->addJs ('https://maps.googleapis.com/maps/api/js?key=AIzaSyA46WZQVEJSS2zf5hZPQW3-oV6P5RSCUDQ&callback=initMap');
?>
<div class="contacts-block">
    <div class="contacts-block-left">
        <div class="map-left-side-list">
            <div class="page-block-title">
                <h2 class="title">контакты</h2>
                <span class="text">Daisy is sagittis sem nibh id elit</span>
            </div>

            <ul class="contacts-block-map-list">
                <li>
                    <i class="fas fa-phone"></i>
                    <div class="contacts-block-data-wrap">
                        <span>Телефон</span>
                        <span>8 800 555 23 54</span>
                    </div>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <div class="contacts-block-data-wrap">
                        <span>Почтовый адрес</span>
                        <span>yudinanatasha@mail.ru</span>
                        <span>viktorkomteka@mail.ru</span>
                    </div>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="contacts-block-data-wrap">
                        <span>Адрес</span>
                        <span>ул. Карла Маркса д.2 оф.15</span>
                    </div>
                </li>
            </ul>

            <div class="contacts-map-form">
                <div class="page-block-title">
                    <h3>Задать нам вопрос</h3>
                    <span>Мы с радостью ответим на все ваши вопросы</span>
                </div>
            </div>
        </div>
    </div>
    <div id="contacts_map_canvas" class="contacts-map"></div>
</div>
<?require $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'?>