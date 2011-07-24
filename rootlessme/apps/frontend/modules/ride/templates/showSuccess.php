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
//           $( "#dialogFormDiv" ).dialog({
//                autoOpen: false,
//                //height: 300,
//                //width: 350,
//                modal: true,
//                buttons: {
//                        "Create an account": function() {
//                                var bValid = true;
//                                allFields.removeClass( "ui-state-error" );
//
//                                bValid = bValid && checkLength( name, "username", 3, 16 );
//                                bValid = bValid && checkLength( email, "email", 6, 80 );
//                                bValid = bValid && checkLength( password, "password", 5, 16 );
//
//                                bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
//                                // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
//                                bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
//                                bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
//
//                                if ( bValid ) {
//                                        $( "#users tbody" ).append( "<tr>" +
//                                                "<td>" + name.val() + "</td>" +
//                                                "<td>" + email.val() + "</td>" +
//                                                "<td>" + password.val() + "</td>" +
//                                        "</tr>" );
//                                        $( this ).dialog( "close" );
//                                }
//                        },
//                        Cancel: function() {
//                                $( this ).dialog( "close" );
//                        }
//                },
//                close: function() {
//                        allFields.val( "" ).removeClass( "ui-state-error" );
//                }
//            });

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
        <?php include_component('seat', 'seatForm') ?>
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
<!--        <div><?php echo $driver->getFullName() ?></div>-->
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