function iniciarMapa(){

// CDMX
var LatLng = {lat: 19.4210838, lng: -99.1374843}

// Seteando el mapa
map = new google.maps.Map(document.getElementById('map'), {
  center: LatLng,
  zoom: 10
});

// Creando el marcador para la posicion inicial
/*var marker = new google.maps.Marker({
    position: LatLang,
    map: map,
    title: 'PRueba'
})*/

};