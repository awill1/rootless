<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s to %s', $route->getOriginString(), $route->getDestinationString()))
?>
<h1> Ride Request</h1>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/googleMapHelpers.js"></script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();
        // The text boxes to match depend on the ride type
        var originTextBox = "#seats_route_origin";
        var destinationTextBox = "#seats_route_destination";
        var originDataField = "#seats_route_origin_data";
        var destinationDataField = "#seats_route_destination_data";
        var routeDataField = "#seats_route_route_data";
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
        $(document).ready(function(){
                
            // Create the Google Map
            map = initializeGoogleMap("rideProfileMap");
                
            geocoder = new google.maps.Geocoder();

            // Decode the polyline for the route
            // Workaround for javascript strings, needs backslashes escaped
            var encodedPolyline = "<?php echo str_replace('\\','\\\\',$route->getEncodedPolyline()); ?>";
            routePolyline = displayEncodedPolyline(map, encodedPolyline);

            // Set the bounds of the map to center and zoom on the route
            setMapBoundsToPolyline(map, routePolyline);

            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            
            // Setup the origin and destination marker, the maps are null
            // because the markers are hidden
            originMarker = initializeMarker("Origin");
            destinationMarker = initializeMarker("Destination");
            
            // Setup the path, the maps are null because the path is hidden
            routePolyline = initializePath();

            // Route preview changes whenever the user finished editing the
            // seat pickup and dropoff textboxes
            bindTextBoxesToMap(originTextBox, destinationTextBox);

            // Discover the strange keys used for longitude and latitude
            // in the data returned from google maps api.
            var googleTestString = JSON.stringify(testPoint);
            // this is a random two character string which represents latitude
            //  and longitude in the stringified data
            strangeLat = googleTestString.substring(2,4);
            strangeLon = googleTestString.substring(10,12);

            // When a user clicks on the riderListItem load details about
            // the seat request
            $(".dynamicDetailsLink").click(loadSeatDetails);

            // Change all of the appropriate textboxes to date and time pickers
            $( ".datePicker" ).datepicker();
            $( ".timePicker" ).timepicker({ampm: true});
        });

        function loadSeatDetails() {
            if($('.selectedUser').length > 0) 
            {
              $('.selectedUser').removeClass('selectedUser');
            }
            $(this).parent().append($('#seatSpinnerContainer'));
            $('#seatSpinnerContainer').show();
            $(this).parent().addClass('selectedUser');
 
            $("#seatNegotiationBlock").slideUp("blind");
            $("#seatNegotiationBlock").load($(this).attr("href"),
                function(){
                    $('#negotiationSpinnerContainer').hide();
                    $("#seatNegotiationBlock").slideDown("blind");
                    bindTextBoxesToMap(originTextBox, destinationTextBox);
                });
            // Return false to override default click behavior
            return false;
        }
    </script>
<?php end_slot();?>

<div id="mainRideSummary">
    <div id="mainRideDate" class="dateBlockLarge">
        <div class="dateBlockMonth">
            <?php echo date("M",strtotime($passenger->getStartDate())) ?>
        </div>
        <div class="dateBlockDate">
            <?php echo date("j",strtotime($passenger->getStartDate())) ?>
        </div>
        <div class="dateBlockTime">
            <?php echo date("g:i A",strtotime($passenger->getStartTime())) ?>
        </div>
    </div>
    <h1 id="mainEventTitle">
        <span class="rideLocations">
            <?php echo $route->getOriginString() ?>
        </span>
        <span class="rideMiddleWord">
        to
        </span>
        <span class="rideLocations">
            <?php echo $route->getDestinationString() ?>
        </span>

    </h1>
    <span class="tripDistance">One Way Trip</span>
    <br />
    <span class="seatsAvailable">
        <?php echo $passenger->getPassengerCount() ?>
        <?php echo ($passenger->getPassengerCount() == 1 ? "seat" : "seats") ?>
        needed
    </span>
    <br />
    <span class="tripValue">Trip Value: $<?php echo $passenger->getAskingPrice() ?> per person</span>
    <!-- TODO: Add smoking -->
    <p id="mainRideInformation">
        <?php echo nl2br($passenger->getDescription()) ?>
    </p>

</div>

<div id="rideProfileMap"></div>

<div id="informationContainer">
    <div id="mainRidePeople">
        <h3 class="postedByStyles">Posted By: <a class="personLink" href="<?php echo url_for("profile_show_user", $rider)  ?>"><?php echo $rider->getFullName() ?></a></h3>
        <a href="<?php echo url_for("profile_show_user", $rider)  ?>">
            <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $rider->getPictureUrlLarge() ?>" alt="<?php echo $rider->getFullName() ?>" />
        </a>
        <div class="riderListBlock">
        <h3>Accepted</h3>
            <?php if ($acceptedSeats->count() > 0) :?>
            <ul class="riderList accepted">
                <li class='none' style="display:none;">No Accepted seats</li>
                <?php foreach ($acceptedSeats as $seat):
                    $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                <li class="riderListItem">
                    <?php if ($isMyPost || $seat == $mySeat) :?>
                        <a class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" />
                        </a>
                    <?php else :?>
                        <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" />
                        </a>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
              <ul class="riderList accepted">
                <li class='none'>No Accepted seats</li>
              </ul>
            <?php endif; ?>
        </div>
        <div class="riderListBlock">
            <h3>Declined</h3>
            <?php if ($declinedSeats->count() > 0) :?>
            <ul class="riderList declined">
                <li class='none' style="display:none;">No Declined seats</li>
                <?php foreach ($declinedSeats as $seat):
                    $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                    <li class="riderListItem">
                        <?php if ($isMyPost) :?>
                            <a class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                        <?php else :?>
                            <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <ul class="riderList declined">
                <li class='none'>No Declined seats</li>
              </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="mainRideDetails">
    <?php if ($isMyPost) :?>
        <div class="riderListBlock">
            <h3>Pending</h3>
            <?php if ($pendingSeats->count() > 0) :?>
            <ul class="riderList pending">
                <li class='none' style="display:none;">No Pending seats</li>
                <?php foreach ($pendingSeats as $seat):
                      $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                    <li class="riderListItem">
                        <?php if ($isMyPost) :?>
                            <a class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                        <?php else :?>
                            <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
              <ul class="riderList pending">
                <li class='none'>No Pending seats</li>
              </ul>
            <?php endif; ?>
        </div>
    <?php elseif ($mySeat != null): ?>
        <div class="riderListBlock">
            <h3>My Seat Request</h3>
            <ul class="riderList">
                <?php $myProfile = $mySeat->getCarpools()->getPeople()->getProfiles(); ?>
                <li class="riderListItem">
                    <a class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$mySeat->getSeatId()))  ?>">
                        <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $myProfile->getPictureUrlSmall() ?>" alt="<?php echo $myProfile->getFullName() ?>" />
                    </a>
                </li>
            </ul>
        </div>
        <?php include_component('seat', 'negotiation', array('seat'=>$mySeat)) ?>
    <?php elseif ($myUserId!=null): ?>
        <?php include_component('seat', 'offerForm', array('ride'=>$passenger)) ?>
    <?php else: ?>
        <div>
            You must
            <a href="<?php echo url_for('sf_guard_signin') ?>">login</a>
            or <a href="<?php echo url_for('sf_guard_register') ?>">register</a>
            to request a seat.
        </div>
    <?php endif; ?>
    <div id="seatSpinnerContainer" style="display: none;">
        <img id="negotiationSpinner" alt="Loading..." src="/images/ajax-loader.gif" />
    </div>
    <img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="vertical-align: middle; display: none" />
    <div id ="seatNegotiationBlock">

    </div>
</div>
