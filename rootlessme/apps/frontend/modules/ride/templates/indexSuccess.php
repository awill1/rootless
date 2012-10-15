<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
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
        var routePolylineDataField = "#rides_polyline";
        var polylines = new Object;
        
        // Form submit options used for the ajax form
        var formAjaxOptions = 
        {
            target: '#results',
            success: function()
            {
                // Clear the form submit pending flag
                isFormSubmitPending = false;

                // This handler function will run when the form is complete
                $('#loader').hide();
                $('#results').show('blind');

                // Add the results to the google map
                LoadItemsIntoGoogleMap();

                // Change the hover style
                $("#rideTable tbody tr")
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
        };

        // Function when the page is ready
        $(document).ready(function(){
            
            $('#loader').hide();

            // Handler for the find button
            $('#rides_find').click(function()
              {
                 $('#loader').show();
                 $('#results').toggle('blind');
                 ClearPolylinesFromMap();
              });
              $('#rideSearchForm').submit(function(){
                  // Set the form submit flag
                  isFormSubmitPending = true;
                
                  // Disable the default submission. We will let AJAX do it
                  MaybeSubmitForm();
                  return false;
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
            
            // Set textboxes to match the query string variables
            var origin = getParameterByName('rides\\[origin]');
            var destination = getParameterByName('rides\\[destination]');
            
            if (origin != null)
            {
                $(originTextBox).val(origin);
            }
            if (destination != null)
            {
                $(destinationTextBox).val(destination);
            }
            
            // Search for what is in the textboxes at page load time
            previewRoute();
            $('#rides_find').click(); 
        });
        
        function getParameterByName(name) {
            var queryString = window.location.search;
            queryString = decodeURIComponent(queryString);
            var match = RegExp('[?&]' + name + '=([^&]*)')
                            .exec(queryString);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }


        function HighlightRow(tableRow)
        {
            tableRow.addClass("rideListSelectedRow");
            // Get the polyline from the row
            tableRow.find(".routePolyline").each(function(index) {
                var key = $(this).attr('id');
                polyline = polylines[key];
                HighlightPolyline(polyline);
            });
        }
        
        function UnHighlightRow(tableRow)
        {
          tableRow.removeClass("rideListSelectedRow");
          // Get the polyline from the row
          tableRow.find(".routePolyline").each(function(index) {
              var key = $(this).attr('id');
              polyline = polylines[key];
              UnHighlightPolyline(polyline);
           });
        }
      
        function DoNav(theUrl)
        {
            document.location.href = theUrl;
        }
        
        function LoadItemsIntoGoogleMap()
        {
            $(".routePolyline").each(function(index) {
                var key = $(this).attr('id');
                console.log(key);
                var encodedPolyline = $(this).text();
                // Load the polylines into the google map
                var polyline = displayEncodedPolyline(map, encodedPolyline, true);
                polylines[key] = polyline;
            });
            
        }
        
        function ClearPolylinesFromMap()
        {
            for (var polyline in polylines)
            {
                // Clear the polyline from the google map
                polylines[polyline].setMap(null);
                // Remove the polyline from the list of lines
                delete polylines[polyline];
            }
        }
        
        /**
         * Tries to submit the form. It will only be submitted if none of the
         * blocking flags are set.
         */
        function MaybeSubmitForm()
        {            
            // Check to make sure nothing is blocking submitting the form
            if (canSubmitForm() && isFormSubmitPending)
            {
                $('#rideSearchForm').ajaxSubmit(formAjaxOptions);
            }
        }

    </script>

<?php end_slot();?>

<h1>Find a Ride</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 10%; position: relative; top: 75px;" />
<div id="results">
</div>