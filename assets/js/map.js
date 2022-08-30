var map;
jQuery(document).ready(function(){

    map = new GMaps({
        div: '#map',
        lat: 34.0063783,
        lng: 71.5508818,
    });
    map.addMarker({
        lat: 34.0063783,
        lng: 71.5508818,
        title: 'Address',      
        infoWindow: {
            content: '<h5 class="title">Edwardes College</h5><p><span class="region">2, The Mall</span><br><span class="postal-code">Peshawar Cantonment,  Khyber Pakhtunkhwa </span><br><span class="country-name">Pakistan</span></p>'
        }
        
    });

});