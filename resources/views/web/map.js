
   function sub(){
      calculateRoute($("#from").val(), $("#to").val());
    }
  function codeAddress(a) {
    if(a==1){
       var address = document.getElementById('from-link').value;
    }else{
       var address = document.getElementById('to-link').value;
    }
    
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
      console.log(results);
      if (status == 'OK') {
       if(a==1){
         $("#from").val(results[0].formatted_address);
       }else{
         $("#to").val(results[0].formatted_address);
       }
        
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
  function calculateRoute(from, to) {
    // Center initialized to Naples, Italy
    var myOptions = {
      zoom: 10,
      center: new google.maps.LatLng(40.84, 14.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // Draw the map
    var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

    var directionsService = new google.maps.DirectionsService();
    var directionsRequest = {
      origin: from,
      destination: to,
      provideRouteAlternatives: true,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(
    directionsRequest,
    function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            for (var i = 0, len = response.routes.length; i < len; i++) {
                new google.maps.DirectionsRenderer({
                    map: mapObject,
                    directions: response,
                    routeIndex: i
                });
            }
        } else {
            $("#error").append("Unable to retrieve your route<br />");
        }
    }
);
  }

