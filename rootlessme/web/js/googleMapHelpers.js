/*
 * This is the javascript for the Google Map Helper functions.
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

/**
 * Constants used for google maps
 */
var PRIMARY_ROUTE_COLOR = "#119F49";
var PRIMARY_ROUTE_OPACITY = .5;
var PRIMARY_ROUTE_WEIGHT = 5;
var SECONDARY_ROUTE_COLOR = "#FF0000";
var SECONDARY_ROUTE_OPACITY = .5;
var SECONDARY_ROUTE_WEIGHT = 5;
var TERTIARY_ROUTE_COLOR = "#FF0000";
var TERTIARY_ROUTE_OPACITY = .2;
var TERTIARY_ROUTE_WEIGHT = 5;

var MAP_DEFAULT_LATITUDE = 37.0625;
var MAP_DEFAULT_LONGITUDE = -95.677068;
var MAP_DEFAULT_ZOOM = 3;

/**
 * Variables used to block form submitting before map spi results are returned
 */
var isOriginDecodePending = false;
var isDestinationDecodePending = false;
var isDirectionsPending = false;
var isFormSubmitPending = false;

/**
 * formatGoogleJSON is used to change the strange keys used for 
 * latitude and longitude into easier to use "lat" and "lon" keys.
 * The quotes must be included or else we could replace unexpected 
 * pieces of the string such as street name or encoded polyline
 */
function formatGoogleJSON(strangeLat, strangeLon, jsonString) {
    // Build the regular expressions, and return the replacement
    var strangeLatRegExp = new RegExp("\""+strangeLat+"\"","g");
    var strangeLonRegExp = new RegExp("\""+strangeLon+"\"","g");
    return jsonString.replace(strangeLatRegExp,"\"lat\"")
                     .replace(strangeLonRegExp, "\"lon\"");
}

/**
 * Initializes a Google Map into a div
 * @param mapId string The id of the div which will contain the map
 * @returns google.maps.Map The created map
 */
function initializeGoogleMap(mapId)
{
    // Google map loading
    var latlng = new google.maps.LatLng(MAP_DEFAULT_LATITUDE, MAP_DEFAULT_LONGITUDE);
    var myOptions = {
        zoom: MAP_DEFAULT_ZOOM,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(mapId),
            myOptions);
    return map;
}

/**
 * Initializes a marker that is at the default latitude and longitude, but is
 * not displayed on any map.
 * @param title string The title of the marker
 */
function initializeMarker(title)
{
    // Setup the origin and destination marker, the maps are null
    // because the markers are hidden
    var latlng = new google.maps.LatLng(MAP_DEFAULT_LATITUDE, MAP_DEFAULT_LONGITUDE);
    return new google.maps.Marker({
           position: latlng,
           map: null,
           title: title
    });
}

/**
 * Initializes a path with the primary style and no points.
 * @returns google.maps.Polyline The created polyline
 */
function initializePath()
{   
    // Return the a primary polyline
    return createPrimaryPolyline(new Array());
}

/**
 * Displays an encoded polyline on a map
 * @param map google.maps.Map The map
 * @param encodedPolyline string The encoded polyline to display
 * @param isPrimary boolean Decides if the route is primary or not  
 * @returns google.maps.Polyline The decoded polyline that is displayed on the
 * map
 */
function displayEncodedPolyline(map, encodedPolyline, isPrimary)
{
    // Decode the polyline for the route
    var routeCoordinates  = google.maps.geometry.encoding.decodePath(encodedPolyline);
    
    if (isPrimary == true) {
      var routePath = createPrimaryPolyline(routeCoordinates);
    } else {
      var routePath = createNonPrimaryPolyline(routeCoordinates);
    }

    // Bind the polyline to the map
    routePath.setMap(map);
    
    // Return the created polyline
    return routePath;
}

/**
 * Sets the bounds on a map to fit and focus on a polyline
 * @param map google.maps.Map The map
 * @param polyline google.maps.Polyline The polyline to focus the map on
 */
function setMapBoundsToPolyline(map, polyline)
{
    // Set the bounds of the map to center and zoom on the route
    var bounds = new google.maps.LatLngBounds();
    var routeCoordinates = polyline.getPath();
    routeCoordinates.forEach(function(e) {
        bounds.extend(e);
      });
    map.fitBounds(bounds);
}

/**
 * Increases the bounds of a map, if necessary, to include a polyline
 * @param map google.maps.Map The map
 * @param polyline google.maps.Polyline The polyline to add to the map
 */
function setMapBoundsToIncludePolyline(map, polyline)
{
    // Get the bounds of the map and add the new points to the map bounds
    var bounds = map.getBounds();
    var routeCoordinates = polyline.getPath();
    routeCoordinates.forEach(function(e) {
        bounds.extend(e);
      });
    map.fitBounds(bounds);
}

/**
 * Creates a polyline with the primary line style
 * @param polylineCoordinates Array.<LatLng> The coordinates on the line
 * @returns google.maps.Polyline The polyline
 */
function createPrimaryPolyline(polylineCoordinates)
{
    var routePath = new google.maps.Polyline({
        path: polylineCoordinates,
        strokeColor: PRIMARY_ROUTE_COLOR,
        strokeOpacity: PRIMARY_ROUTE_OPACITY,
        strokeWeight: PRIMARY_ROUTE_WEIGHT
    });
    
    // Return the created polyline
    return routePath;
}


/**
 * Creates a polyline with the secondary line style
 * @param polylineCoordinates Array.<LatLng> The coordinates on the line
 * @returns google.maps.Polyline The polyline
 */
function createNonPrimaryPolyline(polylineCoordinates)
{ 
    
    var routePath = new google.maps.Polyline({
        path: polylineCoordinates,
        strokeColor: SECONDARY_ROUTE_COLOR,
        strokeOpacity: SECONDARY_ROUTE_OPACITY,
        strokeWeight: SECONDARY_ROUTE_WEIGHT
    });
    
    // Return the created polyline
    return routePath;
}

/**
 * Binds origin and destination textboxes to the map
 * @param originTextBox The textbox used for origin input
 * @param destinationTextBox The textbox used for destination input
 */
function bindTextBoxesToMap(originTextBox, destinationTextBox) 
{
    // Route preview changes whenever the user finished editing the
    // seat pickup and dropoff textboxes
    $(originTextBox).change(previewRoute);
    $(destinationTextBox).change(previewRoute);
}

/**
 * Clears the origin decode flag used to block form submission before
 * the map api returns
 */
function clearOriginDecodePendingFlag()
{
    // Clear the flag
    isOriginDecodePending = false;
    // Submit the form if necessary and if the function is defined
    if (typeof(MaybeSubmitForm) == typeof(Function))
    {
        MaybeSubmitForm();
    }
}

/**
 * Clears the destination decode flag used to block form submission before
 * the map api returns
 */
function clearDestinationDecodePendingFlag()
{
    // Clear the flag
    isDestinationDecodePending = false;
    // Submit the form if necessary and if the function is defined
    if (typeof(MaybeSubmitForm) == typeof(Function))
    {
        MaybeSubmitForm();
    }
}

/**
 * Clears the directions pending flag used to block form submission before
 * the map api returns
 */
function clearDirectionsPendingFlag()
{
    // Clear the flag
    isDirectionsPending = false;
    // Submit the form if necessary and if the function is defined
    if (typeof(MaybeSubmitForm) == typeof(Function))
    {
        MaybeSubmitForm();
    }
}


/**
 * Verifies a form can be submitted and is not blocked
 * @returns bool True, if the form can be submitted. False, if the form is blocked.
 */
function canSubmitForm()
{
    return !isOriginDecodePending && !isDestinationDecodePending && !isDirectionsPending;
}

// -----------------------------------------
// All functions below this line have dependancies on items existing.
// This needs to be rewritten in the future for better reusability.
// -----------------------------------------

/**
 * Previews a route on the map
 */
function previewRoute()
{
    // Set the pending google map api flags to prevent form submitting
    isOriginDecodePending = true;
    isDestinationDecodePending = true;
    isDirectionsPending = true;

    var originValue = $(originTextBox).val();
    if (originValue)
    {
        // Get the location of the origin, and place a marker on the map
        var originGeocodeRequest = {
            address: originValue
        };
        geocoder.geocode(originGeocodeRequest, geocodeOrigin);
    }
    else
    {
        // Clear the origin pending flag
        clearOriginDecodePendingFlag();
        
        // There is no origin so clear the marker from the map
        originMarker.setMap(null);
        // Clear the search parameters too
        $("#rides_origin_latitude").val("");
        $("#rides_origin_longitude").val("");
        if (typeof(originDataField) != "undefined")
        {
            $(originDataField).val("");
        }
        // Clear the latitude and longitude fields if they exist
        if (typeof(originLatitude) != "undefined")
        {
            $(originLatitude).val("");
        }
        if (typeof(originLongitude) != "undefined")
        {
            $(originLongitude).val("");
        }
    }

    var destinationValue = $(destinationTextBox).val();
    if (destinationValue)
    {
        // Get the location of the destination, and place a marker on the map
        var destinationGeocodeRequest = {
            address: destinationValue
        };
        geocoder.geocode(destinationGeocodeRequest, geocodeDestination);
    }
    else
    {
        // Clear the destination pending flag
        clearDestinationDecodePendingFlag();
        
        // There is no destination so clear the marker from the map
        destinationMarker.setMap(null);
        // Clear the search parameters too
        $("#rides_destination_latitude").val("");
        $("#rides_destination_longitude").val("");
        if (typeof(destinationDataField) != "undefined")
        {
            $(destinationDataField).val("");
        }
        // Update the latitude and longitude fields if they exist
        if (typeof(destinationLatitude) != "undefined")
        {
            $(destinationLatitude).val("");
        }
        if (typeof(destinationLongitude) != "undefined")
        {
            $(destinationLongitude).val("");
        }
    }

    if (originValue && destinationValue)
    {
        // Get the directions
        calcRoute();
    }
    else
    {
        // Clear the directions pending flag
        clearDirectionsPendingFlag();
        
        // Clear the directions from the map
        routePolyline.setMap(null);
        
        // Clear the route data
        if (typeof(routeDataField) != "undefined")
        {
            $(routeDataField).val("");
        }
    }
}

function geocodeOrigin(results, status) {
    // Display the results
    showResults(results, status, originMarker);
    // Send the geocoded information to the server
    if (typeof(originDataField) != "undefined")
    {
        $(originDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
    }
    // Update the latitude and longitude fields if they exist
    if (typeof(originLatitude) != "undefined")
    {
        $(originLatitude).val(originMarker.getPosition().lat());
    }
    if (typeof(originLongitude) != "undefined")
    {
        $(originLongitude).val(originMarker.getPosition().lng());
    }
    
    // Finally, clear the origin pending flag to allow form submission
    clearOriginDecodePendingFlag();
}

function geocodeDestination(results, status) {
    // Display the results
    showResults(results, status, destinationMarker);
    // Send the geocoded information to the server
    if (typeof(destinationDataField) != "undefined")
    {
        $(destinationDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
    }
    // Update the latitude and longitude fields if they exist
    if (typeof(destinationLatitude) != "undefined")
    {
        $(destinationLatitude).val(destinationMarker.getPosition().lat());
    }
    if (typeof(destinationLongitude) != "undefined")
    {
        $(destinationLongitude).val(destinationMarker.getPosition().lng());
    }
    
    // Finally, clear the destination pending flag to allow form submission
    clearDestinationDecodePendingFlag();
}

function showResults(results, status, marker) {
  if (! results) {
    alert("Geocoder did not return a valid response");
  } else {
    if (status == google.maps.GeocoderStatus.OK) {
        var myLatLng = results[0].geometry.location;
        marker.setPosition(myLatLng);
        marker.setMap(map);
        map.panTo(myLatLng);
    } else {
        // There was a problem with the geocoding
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
        if (typeof(routeDataField) != "undefined")
        {
            $(routeDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(result)));
        }

        // Display the directions
        routePolyline.setPath(result.routes[0].overview_path);
        routePolyline.setMap(map);
        map.fitBounds(result.routes[0].bounds);
    }
    // Finally, clear the directions pending flag to allow form submission
    clearDirectionsPendingFlag();
  });
}

