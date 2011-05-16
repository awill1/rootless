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
            $('#rides_origin').change(previewRoute);
            $('#rides_destination').change(previewRoute);

               // Handler for the find button
              $('#rides_find').click(function()
              {
                 $('#loader').show();
                  $('#results').load(
                    $(this).parents('form').attr('action'),
                    {  },
                    function() { $('#loader').hide(); }
                  );
              });
           
        });

        function previewRoute() {
            var originValue = $("#rides_origin").val();
            var destinationValue = $("#rides_destination").val();
            if (originValue)
            {
                // Get the location of the origin, and place a marker on the map
                var originGeocodeRequest = {
                    address: originValue
                };
                geocoder.geocode(originGeocodeRequest, geocodeOrigin);
            }

            if (destinationValue)
            {
                // Get the location of the destination, and place a marker on the map
                var destinationGeocodeRequest = {
                    address: destinationValue
                };
                geocoder.geocode(destinationGeocodeRequest, geocodeDestination);
            }

            // Get the directions
            calcRoute(originValue, destinationValue);
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

        function calcRoute(start, end) {
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
<div id="searchForm">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<div id="results">
    <?php include_partial('ridesList', array('carpools' => $carpools)) ?>
    <img id="loader" src="/images/ajax-loader.gif" style="vertical-align: middle; display: none" />
</div>