<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet("ride.css") ?>

<?php slot(
  'title',
  sprintf('Rootless Me - New ride '.$rideType))
?>
<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/googleMapHelpers.js"></script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();
        // The text boxes to match depend on the ride type
        var originTextBox = "<?php echo $rideType == 'offer' ? '#carpools_route_origin' : '#passengers_route_origin'; ?>";
        var destinationTextBox = "<?php echo $rideType == 'offer' ? '#carpools_route_destination' : '#passengers_route_destination'; ?>";
        var originDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_origin_data' : '#passengers_route_origin_data'; ?>";
        var destinationDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_destination_data' : '#passengers_route_destination_data'; ?>";
        var routeDataField = "<?php echo $rideType == 'offer' ? '#carpools_route_route_data' : '#passengers_route_route_data'; ?>";
        var originMarker;
        var destinationMarker;
        var routePolyline;
        // Latitude and longitude key names change in google maps api.
        // This testPoint helps us figure out which letters google is using 
        // this time around.
        var testPoint = new google.maps.LatLng(23,45);
        var strangeLat;
        var strangeLon;


        // Function when the page is ready
        $(function(){
            // Create the Google Map
            map = initializeGoogleMap("RequestMap");
            
            geocoder = new google.maps.Geocoder();
            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            
            
            // Setup the origin and destination marker, the maps are null
            // because the markers are hidden
            originMarker = initializeMarker("Origin");
            destinationMarker = initializeMarker("Destination");
            
            // Setup the path, the maps are null because the path is hidden
            routePolyline = initializePath();
            
            // Route preview changes whenever the user finished editing the
            // origin or destination textboxes
            bindTextBoxesToMap(originTextBox, destinationTextBox);
            
            // Discover the strange keys used for longitude and latitude
            // in the data returned from google maps api.
            var googleTestString = JSON.stringify(testPoint);
            // this is a random two character string which represents latitude
            //  and longitude in the stringified data
            strangeLat = googleTestString.substring(2,4);
            strangeLon = googleTestString.substring(10,12);

            // Change the start date and time to be pickers.
            $( ".datePicker" ).datepicker();
            $( ".timePicker" ).timepicker({ampm: true});
            
        });
    </script>

<?php end_slot();?>


<h1>New ride <?php echo $rideType ?></h1>
<div id="newRideFormArea" class="middleRidesFormArea">
<?php include_partial($partial, array('form' => $form)) ?>
</div>
<div id="RequestMap"></div>
