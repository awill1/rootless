<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Rideboard'))
?>

<?php slot('gmapheader'); ?>

    <script type="text/javascript" src="/js/jquery.form.js"></script>
    
    <script type="text/javascript">
        $(function() {
		$( "#rides_date" ).datepicker();
	});
    </script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();
        var originMarker;
        var destinationMarker;

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
            
            // Setup the origin and destination marker
//            originMarker = new google.map.Marker();
//            originMarker.setPosition(latlng);
//            originMarker.setMap(map);
            originMarker = new google.maps.Marker({
                   position: latlng,
                   map: map,
                   title:"Hello World!"
                });

            // Route preview changes whenever the user finished editing the
            // origin or destination textboxes
            $('#rides_origin').change(previewRoute);
            $('#rides_destination').change(previewRoute);

            // Handler for the find button
              $('#rides_find').click(function()
              {
                 $('#loader').show();
                 $('#results').toggle('blind');
//                  $('#results').load(
//                    $(this).parents('form').attr('action'),
//                    {  },
//                    function() { $('#loader').hide(); }
//                  );
              });
            $('#rideSearchForm').ajaxForm(
            {
                target: '#results',
                success: function()
                {
                    // This handler function will run when the form is complete
                    $('#loader').hide();
                    $('#results').toggle('blind');
                    $("#rideTable tbody tr")
                    //.click(function(){
                    //    // Navigate to the first link's reference
                    //    DoNav($(this).find("a").attr("href"));
                    //    //DoNav("http://www.rootless.me.localhost/frontend_dev.php/messages/22");
                    //})
                    // Change the hover style
                    .hover(
                        function()
                        {
                            HighlightRow($(this))
                        }
                        ,function()
                        {
                            UnHighlightRow($(this))
                        }
                    )
                    .find('td:not(:has(:checkbox, a))')
                        .click(function () {
                        window.location = $(this).parent().find("a").attr("href");
                    });
                }
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
            else {
                // There is no origin so clear the marker from the map
                originMarker.setMap(null);
            }

            if (destinationValue)
            {
                // Get the location of the destination, and place a marker on the map
                var destinationGeocodeRequest = {
                    address: destinationValue
                };
                geocoder.geocode(destinationGeocodeRequest, geocodeDestination);
            }
            else {
                // There is no destination so clear the marker from the map
                destinationMarker.setMap(null);
            }

            // Get the directions
            calcRoute(originValue, destinationValue);
        }

        function geocodeOrigin(results, status) {
            var locationNumber = 0;
//            originMarker.setPosition(results[0].geometry.location);
            showResults(results, status, originMarker);
            // Send the geocoded information to the server
            $("#rides_origin_latitude").val(JSON.stringify(locations[locationNumber].lat()));
            $("#rides_origin_longitude").val(JSON.stringify(locations[locationNumber].lng()));
        }

        function geocodeDestination(results, status) {
            var locationNumber = 1;
            showResults(results, status, destinationMarker);
            // Send the geocoded information to the server
            $("#rides_destination_latitude").val(JSON.stringify(locations[locationNumber].lat()));
            $("#rides_destination_longitude").val(JSON.stringify(locations[locationNumber].lng()));
        }

        function showResults(results, status, marker) {
          if (! results) {
            alert("Geocoder did not return a valid response");
          } else {
            if (status == google.maps.GeocoderStatus.OK) {
                var myLatLng = results[0].geometry.location;
                marker.setPosition(myLatLng);
                marker.setMap(map);
//                var marker = new google.maps.Marker({
//                   position: myLatLng,
//                   map: map,
//                     title:"Hello World!"
//                });
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

        function HighlightRow(tableRow)
        {
            //tableRow.addClass("selectedRow");
            tableRow.addClass("rideListSelectedRow");

        }
        function UnHighlightRow(tableRow)
        {
            //tableRow.removeClass("selectedRow");
            tableRow.removeClass("rideListSelectedRow");
        }

        function DoNav(theUrl)
        {
            document.location.href = theUrl;
        }

    </script>

<?php end_slot();?>

<h1>Rides</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="vertical-align: middle; display: none" />
<div id="results">
    <?php //include_partial('ridesList', array('carpools' => $carpools)) ?>
</div>