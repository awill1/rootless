<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>

<script type="text/javascript" src="/js/jquery.form.js"></script>

<script type="text/javascript">
//    $(document).ready(function()
//    {
//        var map;
//        var directionDisplay;
//        var directionsService = new google.maps.DirectionsService();
//        var geocoder;
//        var locations = new Array();
//        // The text boxes to match depend on the ride type
//        var originTextBox = "#seats_route_origin";
//        var destinationTextBox = "#seats_route_destination";
//        var originDataField = "#seats_route_origin_data";
//        var destinationDataField = "#seats_route_destination_data";
//        var routeDataField = "#seats_route_route_data";
//
//        // Function when the page is ready
//        $(document).ready(function()
//        {
//
//            // Google map loading
//            // Map is already loaded on the page
//            var latlng = new google.maps.LatLng(<?php echo sfConfig::get('app_google_map_default_latitude') ?>, <?php echo sfConfig::get('app_google_map_default_longitude') ?>);
//            var myOptions = {
//                zoom: <?php echo sfConfig::get('app_google_map_default_zoom') ?>,
//                center: latlng,
//                mapTypeId: google.maps.MapTypeId.ROADMAP
//            };
//            map = new google.maps.Map(document.getElementById("map"),
//                myOptions);
//            geocoder = new google.maps.Geocoder();
//            directionsDisplay = new google.maps.DirectionsRenderer();
//            directionsDisplay.setMap(map);
//
//            // Route preview changes whenever the user finished editing the
//            // origin or destination textboxes
//            $(originTextBox).change(previewRoute);
//            $(destinationTextBox).change(previewRoute);
//
////            // Change the start date and time to be pickers.
////            $( ".datePicker" ).datepicker();
////            $( ".timePicker" ).timepicker({ampm: true});
//
//        });
//
//        function previewRoute() {
//            if ($(originTextBox).val())
//            {
//                // Get the location of the origin, and place a marker on the map
//                var originValue = $(originTextBox).val();
//                var originGeocodeRequest = {
//                    address: originValue
//                };
//                geocoder.geocode(originGeocodeRequest, geocodeOrigin);
//            }
//
//            if ($(destinationTextBox).val())
//            {
//                // Get the location of the destination, and place a marker on the map
//                var destinationValue = $(destinationTextBox).val();
//                var destinationGeocodeRequest = {
//                    address: destinationValue
//                };
//                geocoder.geocode(destinationGeocodeRequest, geocodeDestination);
//            }
//
//            // Get the directions
//            calcRoute();
//        }
//
//        function geocodeOrigin(results, status) {
//            var locationNumber = 0;
//            showResults(results, status, locationNumber);
//            // Send the geocoded information to the server
//            $(originDataField).val(JSON.stringify(locations[ locationNumber]));
//        }
//
//        function geocodeDestination(results, status) {
//            var locationNumber = 1;
//            showResults(results, status, locationNumber);
//            // Send the geocoded information to the server
//            $(destinationDataField).val(JSON.stringify(locations[locationNumber]));
//        }
//
//        function showResults(results, status, locationNumber) {
//          if (! results) {
//            alert("Geocoder did not return a valid response");
//          } else {
//            if (status == google.maps.GeocoderStatus.OK) {
//                // Check to see if the location has already been added to the
//                // map
////                if (locations.length >=)
////                {
//                    // Remove the location marker from the map
//                  //  locations[locationNumber].setMep(null);
////                }
//                var myLatlng = results[0].geometry.location;
//                var marker = new google.maps.Marker({
//                   position: myLatlng,
//                   map: map,
//                   title:"Hello World!"
//                });
//                map.panTo(myLatlng);
//                // Add the new location information to the locations array
//                locations[locationNumber] = results[0];
//            } else {
//
//            }
//          }
//        }
//
//        function calcRoute() {
//          var start = $(originTextBox).val();
//          var end = $(destinationTextBox).val();
//          var request = {
//            origin:start,
//            destination:end,
//            travelMode: google.maps.TravelMode.DRIVING
//          };
//          directionsService.route(request, function(result, status) {
//            if (status == google.maps.DirectionsStatus.OK) {
//
//                // Set the route field to the results object for posting to the
//                // server
//                $(routeDataField).val(JSON.stringify(result));
//
//                // Display the directions
//                directionsDisplay.setDirections(result);
//            }
//          });
//        }
//

</script>
<?php end_slot();?>


<form class="userInputForm" action="<?php echo url_for('seats_create') ?>" method="post">
  <table>
    <tbody>
      <?php echo $seatForm->renderHiddenFields() ?>
      <?php echo $seatForm['route']['origin']->renderRow() ?>
      <?php echo $seatForm['route']['destination']->renderRow() ?>
      <?php echo $seatForm['carpool_id']->renderRow() ?>
      <?php echo $seatForm['passenger_id']->renderRow() ?>
      <?php echo $seatForm['seat_status_id']->renderRow() ?>
      <?php echo $seatForm['seat_request_type_id']->renderRow() ?>
      <?php echo $seatForm['price']->renderRow() ?>
      <?php echo $seatForm['seat_count']->renderRow() ?>
      <?php echo $seatForm['description']->renderRow() ?>
      <?php //echo $seatForm ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input id="rides_find" type="button" value="Submit" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
