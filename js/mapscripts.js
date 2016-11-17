/*----------Detail Page Map Fuction----------------------*/

function detailLocation() {
    var locallat = new google.maps.LatLng(-19.32029940,146.76231680);
    
    var map = new google.maps.Map(document.getElementById("detailmap"), {
        zoom: 15,
        center: locallat,
		scrollwheel: false,
		
    });

var marker = new google.maps.Marker({
      position: locallat,
      map: map,

  });



var content = '<h3>Townsville Childrens Hospital</h3><h4>100 Angus Smith Dr Douglas QLD 4814</h4>';
    
var infowindow = new google.maps.InfoWindow({content: content});

infowindow.open(map,marker)
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });

    
}
    
    
/*-------------------------------------------------------*/