<style>
#map {
    height: 600px;
}
</style>
<h1>Calculate your route</h1>
<form id="calculate-route" name="calculate-route" action="#" method="get">
  <label for="from">From:</label>
  <select class="" id="from-link" name="from" required="required">
  <option value="">--Select Pickup--</option>
  @if(isset($locations) && count($locations)>0)
    @foreach($locations as $loc)
     <option value="{{$loc->name}}">{{$loc->name}}</option>
    @endforeach
  @endif  
</select>
  <br />

  <label for="to">To:</label>
 <select class="" id="to-link" name="to" required="required">
  <option value="">--Select destination--</option>
  @if(isset($locations) && count($locations)>0)
    @foreach($locations as $loc)
     <option value="{{$loc->name}}">{{$loc->name}}</option>
    @endforeach
  @endif  
</select>
  
  <br />

  <input type="submit" />
  <input type="reset" />
  <div id="map"></div>
</form> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

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

  $(document).ready(function() {
    // If the browser supports the Geolocation API
    if (typeof navigator.geolocation == "undefined") {
      $("#error").text("Your browser doesn't support the Geolocation API");
      return;
    }

    $("#from-link, #to-link").click(function(event) {
      event.preventDefault();
      var addressId = this.id.substring(0, this.id.indexOf("-"));

      navigator.geolocation.getCurrentPosition(function(position) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
          "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
        },
        function(results, status) {
          if (status == google.maps.GeocoderStatus.OK)
            $("#" + addressId).val(results[0].formatted_address);
          else
            $("#error").append("Unable to retrieve your address<br />");
        });
      },
      function(positionError){
        $("#error").append("Error: " + positionError.message + "<br />");
      },
      {
        enableHighAccuracy: true,
        timeout: 10 * 1000 // 10 seconds
      });
    });

    $("#calculate-route").submit(function(event) {
      event.preventDefault();
      calculateRoute($("#from").val(), $("#to").val());
    });
  });
</script>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0o-byXN4NqELDJL--_h9vXW4RerIOsrA&libraries=places
"></script>