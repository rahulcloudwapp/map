<!DOCTYPE html>
<html lang="en">
<head>
  <title>Map</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
#map {
    height: 600px;
}
</style>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Find route between two points </h1>
   
</div>
  
<div class="container">
 
<form id="calculate-route" name="calculate-route" action="#" method="get">
  <label for="from">From:</label>
  <select class="form control" id="from-link" name="from" required="required" onchange="codeAddress(1)">
  <option value="">--Select Pickup--</option>
  @if(isset($locations) && count($locations)>0)
    @foreach($locations as $loc)
     <option value="{{$loc->name}}">{{$loc->name}}</option>
    @endforeach
  @endif  
</select>
  <br />

  <label for="to">To:</label>
 <select  class="form control" id="to-link" name="to" required="required" onchange="codeAddress(2)">
  <option value="">--Select destination--</option>
  @if(isset($locations) && count($locations)>0)
    @foreach($locations as $loc)
     <option value="{{$loc->name}}">{{$loc->name}}</option>
    @endforeach
  @endif  
</select>
  <input type="hidden" id="from">
  <input type="hidden" id="to">
  <br />

  <button type="button" onclick="sub()" >Submit</button>
  <input type="reset" />
  <div id="map"></div>
</form> 

</div>
<script>
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

</script>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0o-byXN4NqELDJL--_h9vXW4RerIOsrA&libraries=places
"></script>
</body>
</html>


