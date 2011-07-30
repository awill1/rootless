<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s to %s', $origin->getCityStateString(), $destination->getCityStateString()))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();


        $(function() {
            $( "#dialogFormDiv" ).dialog({
                autoOpen: false,
                modal: true
            });

            $( "#requestRideButton" ).button()
                .click(function() {
                        $( "#dialogFormDiv" ).dialog( "open" );
            });

//            $( "#requestRideButton" ).button()
//                .click(function() {
//                        $( "#dialogFormDiv" ).toggle('blind');
//            });

            // Hide the new review form initially
//            $('#dialogFormDiv').hide();


	});

        // Function when the page is ready
        $(document).ready(function(){

            // Google map loading
            var latlng = new google.maps.LatLng(<?php echo sfConfig::get('app_google_map_default_latitude') ?>, <?php echo sfConfig::get('app_google_map_default_longitude') ?>);
            var myOptions = {
                zoom: <?php echo sfConfig::get('app_google_map_default_zoom') ?>,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("rideProfileMap"),
                myOptions);
            geocoder = new google.maps.Geocoder();

            // Decode the polyline for the route
            // Workaround for javascript strings, needs backslashes escaped
            var encodedPolyline = "<?php echo str_replace('\\','\\\\',$carpoolRoute->getEncodedPolyline()); ?>";
            var routeCoordinates  = google.maps.geometry.encoding.decodePath(encodedPolyline);
            var routePath = new google.maps.Polyline({
                path: routeCoordinates,
                strokeColor: "#119F49",
                strokeOpacity: .5,
                strokeWeight: 5
            });

            routePath.setMap(map);

            // Set the bounds of the map to center and zoom on the route
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < routeCoordinates.length; i++) {
                bounds.extend(routeCoordinates[i]);
            }
            map.fitBounds(bounds);


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
    </script>
<?php end_slot();?>

<div id="mainRideSummary">
    <div id="mainRideDate" class="dateBlockLarge">
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
    <h1 id="mainEventTitle">
        <span class="rideLocations">
            +<?php echo $origin->getCityStateString() ?>
        </span>
        <span class="rideMiddleWord">
        to
        </span>
        <span class="rideLocations">
            +<?php echo $destination->getCityStateString() ?>
        </span>

    </h1>
    <p class="seatsAvailable">

        <?php echo $carpool->getSeatsAvailable() ?>
        <?php echo ($carpool->getSeatsAvailable() == 1 ? "seat" : "seats") ?>
        available

    </p>
    <div id="dialogFormDiv" title="Request a ride">
        <?php include_component('seat', 'seatForm', array('ride_type'=>'offer', 'ride'=>$carpool)) ?>
    </div>
    <!-- TODO: Add smoking -->
    <p class="smokingPreference">Smoking: Yes</p>
    <p class="tripDistance">One Way Trip</p>
    <p><button id="requestRideButton">Request a Ride</button></p>

</div>

    <div id="rideProfileMap"></div>

    <div id="informationContainer">
<div id="mainRidePeople">
    <a href="<?php echo url_for("profile_show_user", $driver)  ?>">
        <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlLarge() ?>" alt="<?php echo $driver->getFullName() ?>" />
    </a>
    <h3>Riding</h3>
        <p class="riderPicturesFirst"><a href="profile.html"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?>profile_lauren_small.JPG" alt="DJ" /></a></p>
        <p class="riderPictures"><a href="profile.html"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?>profile_lauren_small.JPG" alt="Zach" /></a></p>
        <p class="riderPictures"><a href="profile.html"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?>profile_lauren_small.JPG" alt="Peter" /></a></p>
</div>
<div id="mainRideDetails">
    <h3 class="postedByStyles">Posted By: <a class="personLink" href="<?php echo url_for("profile_show_user", $driver)  ?>"><?php echo $driver->getFullName() ?></a></h3>
    <h3>Trip Value: $50</h3>
    <h3>Asking Price: $<?php echo $carpool->getAskingPrice() ?> per person</h3>
    <p id="mainRideInformation"><?php echo nl2br($carpool->getDescription()) ?>
    </p>
</div>
</div>