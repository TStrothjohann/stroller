var hotels = [
  {
    "title": "Forstscheune Ohrnbachtal",
    "url": "http://www.fuerst-leiningen.de/de/_forstundjagd_ohrnbach_festscheune.html",
    "description": "Hier feiern wir.",
    "lat": 49.6994338,
    "lng": 9.1276168,
    "icon": "http://hochzeit.strothjohann.net/wp-content/uploads/2016/02/heart-outline.png"
  },
  {
    "title": "Gasthof Ohrnbachtal",
    "url": "http://www.gasthof-ohrnbachtal.de/",
    "description": "Direkt gegenüber der Scheune.",
    "lat": 49.699993,
    "lng": 9.1271456
  },

  {
    "title": "Landgasthof Geiersmühle",
    "url": "http://www.geiersmuehle.de/",
    "description": "Etwa einen Kilometer von der Scheune entfernt.",
    "lat": 49.7077,
    "lng": 9.1203383
  },
  {
    "title": "Hotel Weyrich",
    "url": "https://www.google.de/maps/place/Hotel+Weyrich/@49.7114099,9.0964242,17z/data=!4m5!1m2!2m1!1sHotel+Weyrich!3m1!1s0x0000000000000000:0xabac3cf55c056855",
    "description": "Wir waren noch nicht da... Probiert es aus.",
    "lat": 49.7114099,
    "lng": 9.0986129
  },
  {
    "title": "Hotel Talblick",
    "url": "http://hotel-talblick.de/",
    "description": "Ca. 5 Minuten im Auto entfernt, wenn die Brücke wieder errichtet ist.",
    "lat": 49.7113391,
    "lng": 9.10074
  },
  {
    "title": "Parkhotel 1970",
    "url": "http://www.parkhotel-1970.de/",
    "description": "Das Parkhotel ist komplett im Stil der 70er Jahre eingerichtet.",
    "lat": 49.71372,
    "lng": 9.0938793
  },
  {
    "title": "Refektorium",
    "url": "http://www.fuerst-leiningen.de/de/_sehenswert_benediktinerabtei_refektorium.html",
    "description": "Die standesamtliche Trauung findet im Refektorium statt.",
    "lat": 49.643317,
    "lng": 9.220427
  }
];


jQuery(document).ready( function() {
  if(jQuery("#map").length > 0){
    initializeMainMap(hotels);
  }
});


//Maps: Single map for event pages and main map on front page

var map;
var markers = [];
var mapStyles = [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}];

function initializeMainMap(json) {

  var mapOptions = {
    zoom: 12,
    center: {lat: 49.6994338, lng: 9.1276168},
    panControl: false,
    mapTypeControl: true,
    streetViewControl: true,
    overviewMapControl: true,
    scrollwheel: false,
    styles: mapStyles
  };

  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  for (var i = json.length - 1; i >= 0; i--) {
    var title = json[i].title;
    var hotelUrl = json[i].url;
    var description = json[i].description;
    var lat = json[i].lat;
    var lng = json[i].lng;
    
    if(json[i].icon){
      var icon = json[i].icon;
    }else{
      var icon = '';
    }
    var latLng = new google.maps.LatLng(lat, lng);
    var marker = new google.maps.Marker({position: latLng, map: map, title: title, description: description, url: hotelUrl, icon: icon});
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent("<div class='infowindow'>" + this.title + ", " + "<br>" + this.description + "<br><a target='_blank' href='" + this.url + "'>Website</a></div>");
      infowindow.open(map, this);
    });
    markers.push(marker);
  }
}


jQuery('.location').on('click', function(){
  var title = jQuery(this).text();
  for (var i = 0; i < markers.length; i++) {
    if(markers[i].title === title){
      map.panTo(markers[i].position);
      markers[i].setAnimation(google.maps.Animation.DROP);
      return;
    }
  }
})



