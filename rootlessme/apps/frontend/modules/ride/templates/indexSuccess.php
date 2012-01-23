<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/js/googleMapHelpers.js"></script>
    
    <script type="text/javascript">
        $(function() {
                $( ".datePicker" ).datepicker();
	});
    </script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var locations = new Array();
        // The text boxes to match depend on the ride type
        var originTextBox = "#rides_origin";
        var destinationTextBox = "#rides_destination";
        var originMarker;
        var destinationMarker;
        var routePolyline;
        var originLatitude = "#rides_origin_latitude";
        var originLongitude = "#rides_origin_longitude";
        var destinationLatitude = "#rides_destination_latitude";
        var destinationLongitude = "#rides_destination_longitude";

        // Function when the page is ready
        $(document).ready(function(){
            
            $('#loader').hide();

            // Handler for the find button
            $('#rides_find').click(function()
              {
                 $('#loader').show();
                 $('#results').toggle('blind');
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

            // Create the Google Map
            map = initializeGoogleMap("map");
            
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

            // Testing the Google autocomplete
            // Right now the text does not fit.
            // Need to add places to the google library list (comma separated)
            // in app.yml
            //autocomplete = new google.maps.places.Autocomplete(document.getElementById("rides_origin"));

            
        });

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

<h1>Find a Ride</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="vertical-align: middle;" />
<div id="results">
</div>