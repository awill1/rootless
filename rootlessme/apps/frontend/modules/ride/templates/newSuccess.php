<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet("ride.css") ?>

<?php slot(
  'title',
  sprintf('Rootless Me - New ride '.$rideType))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array
        // The text boxes to match depend on the ride type
        var originTextBox = "<?php echo $rideType == 'offer' ? '#carpools_route_origin' : '#passengers_route_origin'; ?>";
        var destinationTextBox = "<?php echo $rideType == 'offer' ? '#carpools_route_destination' : '#passengers_route_destination'; ?>";
        var originDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_origin_data' : '#passengers_route_origin_data'; ?>";
        var destinationDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_destination_data' : '#passengers_route_destination_data'; ?>";
        var routeDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_route_data' : '#passengers_route_route_data'; ?>";
        // Latitude and longitude key names change in google maps api.
        // This testPoint helps us figure out which letters google is using 
        // this time around.
        var testPoint = new google.maps.LatLng(23,45);
        var strangeLat;
        var strangeLon;


        // Function when the page is ready
        $(function(){

            // Google map loading
            var latlng = new google.maps.LatLng(<?php echo sfConfig::get('app_google_map_default_latitude') ?>, <?php echo sfConfig::get('app_google_map_default_longitude') ?>);
            var myOptions = {
                zoom: <?php echo sfConfig::get('app_google_map_default_zoom') ?>,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"),
                myOptions);
            geocoder = new google.maps.Geocoder();
            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);

            // Route preview changes whenever the user finished editing the
            // origin or destination textboxes
            $(originTextBox).change(previewRoute);
            $(destinationTextBox).change(previewRoute);
            
            // Discover the strange keys used for longitude and latitude
            // in the data returned from google maps api.
            var googleTestString = JSON.stringify(testPoint);
            // this is a random two character string which represents latitude
            //  and longitude in the stringified data
            strangeLat = new RegExp(googleTestString.substring(2,4),"g");
            strangeLon = new RegExp(googleTestString.substring(10,12),"g");

            // Change the start date and time to be pickers.
            $( ".datePicker" ).datepicker();
            $( ".timePicker" ).timepicker({ampm: true});
            
        });

        function previewRoute() {
            if ($(originTextBox).val())
            {
                // Get the location of the origin, and place a marker on the map
                var originValue = $(originTextBox).val();
                var originGeocodeRequest = {
                    address: originValue
                };
                geocoder.geocode(originGeocodeRequest, geocodeOrigin);
            }

            if ($(destinationTextBox).val())
            {
                // Get the location of the destination, and place a marker on the map
                var destinationValue = $(destinationTextBox).val();
                var destinationGeocodeRequest = {
                    address: destinationValue
                };
                geocoder.geocode(destinationGeocodeRequest, geocodeDestination);
            }

            // Get the directions
            calcRoute();
        }

        function geocodeOrigin(results, status) {
            var locationNumber = 0;
            showResults(results, status, locationNumber);
            // Send the geocoded information to the server
            $(originDataField).val(formatGoogleJSON(JSON.stringify(locations[ locationNumber])));
        }

        function geocodeDestination(results, status) {
            var locationNumber = 1;
            showResults(results, status, locationNumber);
            // Send the geocoded information to the server
            $(destinationDataField).val(formatGoogleJSON(JSON.stringify(locations[locationNumber])));
        }

        function showResults(results, status, locationNumber) {
          if (! results) {
            alert("Geocoder did not return a valid response");
          } else {
            if (status == google.maps.GeocoderStatus.OK) {
                // Check to see if the location has already been added to the
                // map
//                if (locations.length >=)
//                {
                    // Remove the location marker from the map
                  //  locations[locationNumber].setMep(null);
//                }
                var myLatlng = results[0].geometry.location;
                var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                   title:"Hello World!"
                });
                map.panTo(myLatlng);
                // Add the new location information to the locations array
                locations[locationNumber] = results[0];
            } else {

            }
          }
        }

        function calcRoute() {
          var start = $(originTextBox).val();
          var end = $(destinationTextBox).val();
          var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.TravelMode.DRIVING
          };
          directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                // Set the route field to the results object for posting to the
                // server
                $(routeDataField).val(formatGoogleJSON(JSON.stringify(result)));

                // Display the directions
                directionsDisplay.setDirections(result);
            }
          });
        }
        
        // formatGoogleJSON is used to change the strange keys used for 
        // latitude and longitude into easier to use "lat" and "lon" keys.
        function formatGoogleJSON(jsonString) {
            return jsonString.replace(strangeLat,"lat").replace(strangeLon, "lon");
        }

    </script>

<?php end_slot();?>

<h1>New ride <?php echo $rideType ?></h1>
<div id="newRideFormArea" class="middleRidesFormArea">
<?php include_partial($partial, array('form' => $form)) ?>
</div>
<div id="map"></div>
