<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s to %s', $origin->getCityStateString(), $destination->getCityStateString()))
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
        // Latitude and longitude key names change in google maps api.
        // This testPoint helps us figure out which letters google is using
        // this time around.
        var testPoint = new google.maps.LatLng(23,45);
        var strangeLat;
        var strangeLon;


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
            var encodedPolyline = "<?php echo str_replace('\\','\\\\',$passengerRoute->getEncodedPolyline()); ?>";
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
            // seat pickup and dropoff textboxes
            bindTextBoxesToMap();

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

        function bindTextBoxesToMap() {
            // Route preview changes whenever the user finished editing the
            // seat pickup and dropoff textboxes
            $(originTextBox).change(previewRoute);
            $(destinationTextBox).change(previewRoute);
        };

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
            $(originDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(locations[ locationNumber])));
        }

        function geocodeDestination(results, status) {
            var locationNumber = 1;
            showResults(results, status, locationNumber);
            // Send the geocoded information to the server
            $(destinationDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(locations[locationNumber])));
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
                $(routeDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(result)));

                // Display the directions
                directionsDisplay.setDirections(result);
            }
          });
        }

        function loadSeatDetails() {
            if($('.selectedUser').length > 0) {
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
                    bindTextBoxesToMap();
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
            <?php echo $origin->getCityStateString() ?>
        </span>
        <span class="rideMiddleWord">
        to
        </span>
        <span class="rideLocations">
            <?php echo $destination->getCityStateString() ?>
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
                <?php foreach ($acceptedSeats as $seat):
                    $driverProfile = $seat->getCarpools()->getPeople()->getProfiles()->getFirst(); ?>
                <li class="riderListItem">
                    <li class='none' style="display:none;">No Accepted seats</li>
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
                    $driverProfile = $seat->getCarpools()->getPeople()->getProfiles()->getFirst(); ?>
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
                      $driverProfile = $seat->getCarpools()->getPeople()->getProfiles()->getFirst(); ?>
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
                <?php $myProfile = $mySeat->getCarpools()->getPeople()->getProfiles()->getFirst(); ?>
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
