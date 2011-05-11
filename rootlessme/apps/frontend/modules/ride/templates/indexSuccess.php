<?php use_javascript(sfConfig::get('app_jquery_script')) ?>
<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();

        // Function when the page is ready
        $(document).ready(function(){

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
            $('#carpools_route_origin').change(previewRoute);
            $('#carpools_route_destination').change(previewRoute);
           
        });

        function previewRoute() {
            if ($("#carpools_route_origin").val())
            {
                // Get the location of the origin, and place a marker on the map
                var originValue = $("#carpools_route_origin").val();
                var originGeocodeRequest = {
                    address: originValue
                };
                geocoder.geocode(originGeocodeRequest, geocodeOrigin);
            }

            if ($("#carpools_route_destination").val())
            {
                // Get the location of the destination, and place a marker on the map
                var destinationValue = $("#carpools_route_destination").val();
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
            $("#carpools_route_origin_data").val(JSON.stringify(locations[ locationNumber]));
        }

        function geocodeDestination(results, status) {
            var locationNumber = 1;
            showResults(results, status, locationNumber);
            // Send the geocoded information to the server
            $("#carpools_route_destination_data").val(JSON.stringify(locations[locationNumber]));
        }

        function showResults(results, status, locationNumber) {
          if (! results) {
            alert("Geocoder did not return a valid response");
          } else {
            if (status == google.maps.GeocoderStatus.OK) {
                var myLatlng = results[0].geometry.location;
                var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                     title:"Hello World!"
                });
                map.panTo(myLatlng);
                locations[locationNumber] = results[0];
            } else {

            }
          }
        }

        function calcRoute() {
          var start = $("#carpools_route_origin").val();
          var end = $("#carpools_route_destination").val();
          var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.TravelMode.DRIVING
          };
          directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                // Set the route field to the results object for posting to the
                // server
                $("#carpools_route_route_data").val(JSON.stringify(result));

                // Display the directions
                directionsDisplay.setDirections(result);
            }
          });
        }

    </script>

<?php end_slot();?>

<h1>Rideboard</h1>
<div id="map"></div>
<table id="rideTable">
    <thead>
        <tr >
            <th>Date</th>
            <th>Origin</th>
            <th>&nbsp;</th>
            <th>Destination</th>
            <th>Creator</th>
            <th>Type</th>
            <th># of Seats</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($carpools as $i => $carpool): ?>
        <tr class="<?php echo fmod($i, 2) ? 'rideListNotSelectedAltRow' : 'rideListNotSelectedRow' ?>">
            <td>
                <div class="dateBlockLarge">
                    <div class="dateBlockMonth">
                        <?php echo date("M",strtotime($carpool->getStartDate())) ?>
                    </div>
                    <div class="dateBlockDate">
                        <?php echo date("j",strtotime($carpool->getStartDate())) ?>
                    </div>
                    <div class="dateBlockTime">
                        <?php echo date("g:i A",strtotime($carpool->getStartTime())) ?>
                    </div>
                </div>
            </td>
            <td><?php echo $carpool->getOriginLocation()->getCityStateString() ?></td>
            <td>to</td>
            <td><?php echo $carpool->getDestinationLocation()->getCityStateString() ?></td>
            <td>
                <a href="<?php echo url_for("profile_show_user", $carpool->getPeople()->getProfiles()->getFirst()) ?>">
                    <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $carpool->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $carpool->getPeople() ?>" /> <?php echo $carpool->getPeople() ?>
                </a>
            </td>
            <td><a href="<?php echo url_for("ride_offer",$carpool) ?>">Offer</a></td>
            <td><?php echo $carpool->getSeatsAvailable() ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>