/*
 * Constructor for radio form styling
 * jQuery is a dependency.
 * @param <jQuery Object> formElem Form being styled
 */


var map = null;
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var geocoder;
var locations = new Array();
// The text boxes to match depend on the ride type
var originTextBox = "#origin";
var destinationTextBox = "#destination";
var originDataField = "#rides_origin_data";
var destinationDataField = "#rides_destination_data";
var routeDataField = "#rides_route_data";
var originMarker;
var destinationMarker;
var routePolyline;
var originLatitude = "#rides_origin_latitude";
var originLongitude = "#rides_origin_longitude";
var destinationLatitude = "#rides_destination_latitude";
var destinationLongitude = "#rides_destination_longitude";
var polylines = new Object;
// Latitude and longitude key names change in google maps api.
// This testPoint helps us figure out which letters google is using 
// this time around.
var testPoint = new google.maps.LatLng(23,45);
var strangeLat;
var strangeLon;

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
        

$(document).ready(function()
{
    $('#formConfirmations').hide();
    
    //Change the placeholder text in the seats field to match the user context
    $('#driveButton').click(function() {
        $('#seatsField').attr('placeholder', 'How many spare seats?');
    });
    
    $('#rideButton').click(function() {
        $('#seatsField').attr('placeholder', 'How many passengers?');
    });
    
    // Form field change event handler
    $('.formFields').change(function(){
        // Send an event to google analytics for the type of form field changed
        _gaq.push(['_trackEvent', 'nycEvent', 'changeFormField', $(this).attr('name')]);
    });
    
    // Create the Google Map
    map = initializeGoogleMap("map");
    
    // Center the map on NYC
    var nycPoint = new google.maps.LatLng(40.714353, -74.005973);
    map.setCenter(nycPoint);
    map.setZoom(9);
    

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
    
    //Ajax form success
    $('#specialForm').validate({
        invalidHandler: function() {
            // Send an event to google analytics for the form validation error
            _gaq.push(['_trackEvent', 'nycEvent', 'validationError']);
        },
        messages: {
            name: "Enter your name. ",
            email: {
                required: "Enter your email. ",
                email: "Email must be a valid format. "
            },
            location: "Enter your location. ",
            seats: {
                required: "Enter the number of seats. ",
                digits: "The seat count must be a valid number. "
            }
        }
    });
    $('#rideSearchForm').click(function(){
        // Set the form submit flag
        isFormSubmitPending = true;

        // Disable the default submission. We will let AJAX do it
        MaybeSubmitForm();
        return false;
    });
    $('#specialForm').ajaxForm( 
        {
            beforeSubmit: function() {
                //blocking
                $("#specialForm").block({ 
                    message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
                }); 
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'nycEvent', 'registerSubmitted']);
            },
            error: function() {
                $("#specialForm").unblock();
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'nycEvent', 'registerError']);
            },
            // The callback function when the form was successfully submitted
            success: function(responseText, statusText, xhr) {
                alert(responseText);
                $('#formConfirmations').show('blind');
                $("#specialForm").unblock();
                
                // Send an event to google analytics to show the form was submitted properly
                _gaq.push(['_trackEvent', 'nycEvent', 'registerSuccess']);
            }
        });
        
        // Set the start date and time to be the current value
        var currentTime = new Date();
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        var dateString = month + "/" + day + "/" + year;
        var ampm = "am";
        var hours = currentTime.getHours();
        // Get the pm if it is after 11:59
        if (hours > 11)
        {
            ampm = "pm"
        }
        // Change zero hour to 12
        if (hours == 0)
        {
            hours = 12;
        }
        // Need the minutes to always be 2 digits wide
        var minutes = ("0" + currentTime.getMinutes()).slice (-2);;
        var timeString = hours + ":" + minutes + " " + ampm;
        $("#date").attr('value', dateString);
        $("#time").attr('value', timeString);
        
    // Change the start date and time to be pickers.
    $( ".datePicker" ).datepicker();
    $( ".timePicker" ).timepicker({ampm: true});
});



        
        

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

//            // Create the Google Map
//            map = initializeGoogleMap("map");
//            
//            geocoder = new google.maps.Geocoder();
//            directionsDisplay = new google.maps.DirectionsRenderer();
//            directionsDisplay.setMap(map);
//
//            // Setup the origin and destination marker, the maps are null
//            // because the markers are hidden
//            originMarker = initializeMarker("Origin");
//            destinationMarker = initializeMarker("Destination");
//
//            // Setup the path, the maps are null because the path is hidden
//            routePolyline = initializePath();
//
//            // Route preview changes whenever the user finished editing the
//            // origin or destination textboxes
//            bindTextBoxesToMap(originTextBox, destinationTextBox);

            // Testing the Google autocomplete
            // Right now the text does not fit.
            // Need to add places to the google library list (comma separated)
            // in app.yml
            //autocomplete = new google.maps.places.Autocomplete(document.getElementById("rides_origin"));
            
//            // Set textboxes to match the query string variables
//            var origin = getParameterByName('rides\\[origin]');
//            var destination = getParameterByName('rides\\[destination]');
//            
//            if (origin != null)
//            {
//                $(originTextBox).val(origin);
//            }
//            if (destination != null)
//            {
//                $(destinationTextBox).val(destination);
//            }
            
//            // Search for what is in the textboxes at page load time
//            previewRoute();
//            $('#rides_find').click(); 
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
