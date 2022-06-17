var map;
var geocoder;

function initMap(){

	// The location of Uluru
  var uluru = {lat: 7.7102, lng: 81.6924};
  // The map, centered at Uluru
   map = new google.maps.Map(
      document.getElementById('map'), {zoom: 14, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});


  var data = JSON.parse(document.getElementById("data").innerHTML);
  geocoder = new google.maps.Geocoder();

  codeAddress(data);


}

 function codeAddress(data) {

  Array.prototype.forEach.call(data,function(data){

  	var address = data.name+' '+data.address;
 
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        console.log(results[0].geometry.location)

      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  });
 }