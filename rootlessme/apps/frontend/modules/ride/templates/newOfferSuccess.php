<?php use_javascript("jquery.js") ?>

<?php slot(
  'title',
  sprintf('Rootless Me - New ride offer'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?sensor=false">
    </script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;

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



            // Preview Route button
            //$('#previewRouteButton').click(previewRoute);

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
                geocoder.geocode(originGeocodeRequest, showResults);
            }

            if ($("#carpools_route_destination").val())
            {
                // Get the location of the destination, and place a marker on the map
                var destinationValue = $("#carpools_route_destination").val();
                var destinationGeocodeRequest = {
                    address: destinationValue
                };
                geocoder.geocode(destinationGeocodeRequest, showResults);
            }

            // Get the directions
            calcRoute();
        }

        function showResults(results, status) {
          //var reverse = (clickMarker != null);

          if (! results) {
            alert("Geocoder did not return a valid response");
          } else {
//            document.getElementById("statusValue").innerHTML = status;
//            document.getElementById("statusDescription").innerHTML = GeocoderStatusDescription[status];
//
//            document.getElementById("responseInfo").style.display = "block";
//            document.getElementById("responseStatus").style.display = "block";

            if (status == google.maps.GeocoderStatus.OK) {
//              document.getElementById("matchCount").innerHTML = results.length;
//              document.getElementById("responseCount").style.display = "block";
//              plotMatchesOnMap(results, reverse);


                var myLatlng = results[0].geometry.location;
                var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                     title:"Hello World!"
                });
                map.panTo(myLatlng);
            } else {
//              if (! reverse) {
//                map.setCenter(new google.maps.LatLng(0.0, 0.0));
//                map.setZoom(1);
//              }
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
                //$("#carpools_route_route_data").val(result);
                $("#carpools_route_route_data").val(JSON.stringify(result));
                //$("#carpools_route_route_data").val('This is the result');

                // Display the directions
                directionsDisplay.setDirections(result);
            }
          });
        }

    </script>

<?php end_slot();?>

<h1>New Offer</h1>
<!--<input id="previewRouteButton" type="button" value="Preview route" />-->
<div id="map" style="width: 400px; height: 400px;"></div>
<?php include_partial('form', array('form' => $form)) ?>
