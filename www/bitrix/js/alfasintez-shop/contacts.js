$(document).ready(function() {

    /*--------------------------------- CONTACTS MAP  -----------------------------------*/
    var map;

    function initializeContacts() {
        map = new google.maps.Map(document.getElementById("contacts_map_canvas"), {
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
    }
    google.maps.event.addDomListener(window, 'load', initializeContacts);
    /*--------------------------------- END  -----------------------------------*/

});