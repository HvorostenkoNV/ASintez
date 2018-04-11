$(document).ready(function() {
    /*--------------------------------- MAP  -----------------------------------*/

    var map;

    function initializeIndex() {
         map = new google.maps.Map(document.getElementById("map_canvas"), {
            center: {
                lat: 48.470727,
                lng: 35.027753
            },
            zoom: 15,
            scrollwheel: false,
            zoomControl: true,
            scaleControl: true,
            mapTypeControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        setMarkers(map);
    }
    ///// координаты точек!!!!!
    var beaches = [
        ['27 Sicheslavska naberezhna st.<br>(former Lenina naberezhna st)<br>Dnipro<br>Phone: <a href="tel:+380562350026" style="color: dodgerblue !important"">+380562350026</a>', 48.470727, 35.047753, 4]
    ];

    function setMarkers(map) {
        if ($('#map_canvas').is('[markers-seted]')) return;
        var image = {
            url: '/upload/av-alfasintez/marker.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(65, 65),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 22).
            anchor: new google.maps.Point(10, 35)
        };
        for (var i = 0; i < beaches.length; i++) {
            var beach = beaches[i];
            var marker = new google.maps.Marker({
                position: {
                    lat: beach[1],
                    lng: beach[2]
                },
                map: map,
                animation: google.maps.Animation.DROP,
                icon: image,
                content: beach[0],
                zIndex: beach[3]
            });
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', (function(marker, i, infowindow) {
                return function() {
                    infowindow.setContent(this.content);
                    infowindow.open(map, this);
                };
            })(marker, i, infowindow));
        }
        $('#map_canvas').attr('markers-seted', true);
    }
    google.maps.event.addDomListener(window, 'load', initializeIndex);

    function toggleBounce() {

        marker.setAnimation(google.maps.Animation.BOUNCE);

    }

    /*--------------------------------- END  -----------------------------------*/

    /*--------------------- CAR ANIMATION BG  ----------------------------------*/
    $van_offsetTop = $('.map-left-side ').offset().top;

    $(window).on('scroll', function() {
        if ($(this).scrollTop() >= $van_offsetTop / 1.3) {

            $('#van_map_img').addClass("van_animation").css("background", "url(/bitrix/images/alfasintez-shop/index/map/car.png) no-repeat right");
        } else {
            $('#van_map_img').removeClass("van_animation")
        };
    });

    /*------------------------------ SEO TEXT ----------------------------------*/
    $('.products-subcategories-more').click(function() {
        $(this).toggleClass('cross-rotate');
        $(this).parent().next().slideToggle(600);
    });

    /*---------------------------- SLIDER --------------------------------------*/

    $('.text-slider').slick({
        dots: true,
        arrows: false,
    });
});