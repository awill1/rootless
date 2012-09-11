/*
 * Google Map Object
 * @constructor Rootless.Map
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map');

Rootless.Map = Class.extend({
   /**
    *  Initializes the Google Maps API
    *  @param params {arguments} - but mapId is needed to initialize map
    */
   init : function(params) {
       this._ = $.extend(true, {
           
           //constant variables
           CONST : {
               PRIMARY_ROUTE_COLOR     : "#119F49",
               PRIMARY_ROUTE_OPACITY   : .5,
               PRIMARY_ROUTE_WEIGHT    : 5,
               SECONDARY_ROUTE_COLOR   : "#FF0000",
               SECONDARY_ROUTE_OPACITY : .5,
               SECONDARY_ROUTE_WEIGHT  : 5,
               TERTIARY_ROUTE_COLOR    : "#FF0000",
               TERTIARY_ROUTE_OPACITY  : .2,
               TERTIARY_ROUTE_WEIGHT   : 5,
               MAP_DEFAULT_LATITUDE    : 37.0625,
               MAP_DEFAULT_LONGITUDE   : -95.677068,
               MAP_DEFAULT_ZOOM        : 3
           },
           
           //all html elements referred in the code should go here (including jquery)
           el : {
               $originTextBox        : $("#rides_origin"),
               $destinationTextBox   : $("#rides_destination"),
               $originLatitude       : $("#rides_origin_latitude"),
               $originLongitude      : $("#rides_origin_longitude"),
               $destinationLatitude  : $("#rides_destination_latitude"),
               $destinationLongitude : $("#rides_destination_longitude")
           },
           
           // Variables used to block form submitting before map api results are returned
            formBlock : {
                isOriginDecodePending      : false,
                isDestinationDecodePending : false,
                isDirectionsPending        : false,
                isFormSubmitPending        : false
            },
           
           //map markers and polylines should be here
           mapItem : {
                polyline : {
               
                },
                
                marker : {
                    
                }
           
           },
           
           directionsService : new google.maps.DirectionsService()
           
           
       }, params);
   },
   /**
    * Initializes a Google Map into a div
    */
   mapInit : function(){
       // variable that keeps object available in inner functions
       var self = this;
       
       var latlng = new google.maps.LatLng(self._.CONST.MAP_DEFAULT_LATITUDE, self._.CONST.MAP_DEFAULT_LONGITUDE);
       var myOptions = {
           zoom: self._.CONST.MAP_DEFAULT_ZOOM,
           center: latlng,
           mapTypeId: google.maps.MapTypeId.ROADMAP
       };
        
        var mapObj = new google.maps.Map(document.getElementById(self._.mapId),
            myOptions);
      
        self._.MapObject = mapObj;
        self._.geocoder = new google.maps.Geocoder();
        self._.directionsDisplay = new google.maps.DirectionsRenderer();
        self._.directionsDisplay.setMap(mapObj);

        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        self._.mapItem.marker.originMarker = self.initializeMarker("Origin");
        self._.mapItem.marker.destinationMarker = self.initializeMarker("Destination");
        // Setup the path, the maps are null because the path is hidden
        self._.mapItem.polyline.routePolyline = self.initializePath();
        
        // Route preview changes whenever the user finished editing the
        // origin or destination textboxes
        self.bindTextBoxesToMap(self._.el.$originTextBox, self._.el.$destinationTextBox);
   },
   
   /**
    * Initializes a marker that is at the default latitude and longitude, but is
    * not displayed on any map.
    * @param title string The title of the marker
    */
   initializeMarker : function(title){
       var self = this;
       // Setup the origin and destination marker, the maps are null
       // because the markers are hidden
       var latlng = new google.maps.LatLng(self._.CONST.MAP_DEFAULT_LATITUDE, self._.CONST.MAP_DEFAULT_LONGITUDE);
       return new google.maps.Marker({
           position: latlng,
           map: null,
           title: title
       });
   },
   
   /**
    * Initializes a path with the primary style and no points.
    * @returns google.maps.Polyline The created polyline
    */
   initializePath : function() {
        // Return the a primary polyline
        return this.createPrimaryPolyline(new Array());
   }, 
   
   /**
    * Creates a polyline with the primary line style
    * @param polylineCoordinates Array.<LatLng> The coordinates on the line
    * @returns google.maps.Polyline The polyline
    */
    createPrimaryPolyline : function(polylineCoordinates) {
        var self = this;
        var routePath = new google.maps.Polyline({
            path: polylineCoordinates,
            strokeColor: self._.CONST.PRIMARY_ROUTE_COLOR,
            strokeOpacity: self._.CONST.PRIMARY_ROUTE_OPACITY,
            strokeWeight: self._.CONST.PRIMARY_ROUTE_WEIGHT
        });
    
        // Return the created polyline
        return routePath;
    },
    
    /**
     * Creates a polyline with the secondary line style
     * @param polylineCoordinates Array.<LatLng> The coordinates on the line
     * @returns google.maps.Polyline The polyline
     */
    createNonPrimaryPolyline : function(polylineCoordinates) { 
        var routePath = new google.maps.Polyline({
            path: polylineCoordinates,
            strokeColor: self._.CONST.SECONDARY_ROUTE_COLOR,
            strokeOpacity: self._.CONST.SECONDARY_ROUTE_OPACITY,
            strokeWeight: self._.CONST.SECONDARY_ROUTE_WEIGHT
        });

        // Return the created polyline
        return routePath;
    },
    
    /**
     * Binds origin and destination textboxes to the map
     * @param originTextBox The textbox used for origin input
     * @param destinationTextBox The textbox used for destination input
     */
    bindTextBoxesToMap : function() {
    	var self = this;
        // Route preview changes whenever the user finished editing the
        // seat pickup and dropoff textboxes
        this._.el.$originTextBox.change(self.previewRoute(this._.el.$originTextBox));
        this._.el.$destinationTextBox.change(self.previewRoute(this._.el.$destinationTextBox));
    },
    
    /**
     * Clears the origin decode flag used to block form submission before
     * the map api returns
     */
     clearOriginDecodePendingFlag : function() {
        // Clear the flag
        this._.formBlock.isOriginDecodePending = false;
        // Submit the form if necessary and if the function is defined
        if (typeof(MaybeSubmitForm) == typeof(Function)) {
            MaybeSubmitForm();
        }
    },
    
    /**
     * Clears the destination decode flag used to block form submission before
     * the map api returns
     */
     clearDestinationDecodePendingFlag : function() {
        // Clear the flag
        this._.formBlock.isDestinationDecodePending = false;
        // Submit the form if necessary and if the function is defined
        if (typeof(MaybeSubmitForm) == typeof(Function)) {
            MaybeSubmitForm();
        }
    },
    
    /**
     * Clears the directions pending flag used to block form submission before
     * the map api returns
     */
     clearDirectionsPendingFlag : function() {
        // Clear the flag
        this._.formBlock.isDirectionsPending = false;
        // Submit the form if necessary and if the function is defined
        if (typeof(MaybeSubmitForm) == typeof(Function)) {
            MaybeSubmitForm();
        }
     },
     
     /**
     * Previews a route on the map
     */
     previewRoute : function(formElem) {
     	var self = this;
     	
        // Set the pending google map api flags to prevent form submitting
        this._.formBlock.isOriginDecodePending = true;
        this._.formBlock.isDestinationDecodePending = true;
        this._.formBlock.isDirectionsPending = true;

        var originValue = this._.el.$originTextBox.val();
        if (originValue){
            // Get the location of the origin, and place a marker on the map
            var originGeocodeRequest = {
                address: originValue
            };
            this._.geocoder.geocode(originGeocodeRequest, self.geocodeOrigin);
        } else {
            // Clear the origin pending flag
            this.clearOriginDecodePendingFlag();

            // There is no origin so clear the marker from the map
            this._.mapItem.marker.originMarker.setMap(null);
            // Clear the search parameters too
            this._.el.$originLatitude.val("");
            this._.el.$originLongitude.val("");
            
            if (typeof(originDataField) != "undefined")
            {
                $(originDataField).val("");
            }
            // Clear the latitude and longitude fields if they exist
            if (typeof(this._.el.$originLatitude) != "undefined")
            {
                this._.el.$originLatitude.val("");
            }
            if (typeof(this._.el.$originLongitude) != "undefined")
            {
                this._.el.$originLongitude.val("");
            }
        }

        var destinationValue = this._.el.$destinationTextBox.val();
        if (destinationValue)
        {
            // Get the location of the destination, and place a marker on the map
            var destinationGeocodeRequest = {
                address: destinationValue
            };
            this._.geocoder.geocode(destinationGeocodeRequest, self.geocodeDestination);
        }
        else
        {
            // Clear the destination pending flag
            this.clearDestinationDecodePendingFlag();

            // There is no destination so clear the marker from the map
            this._.mapItem.marker.destinationMarker.setMap(null);
            // Clear the search parameters too
            this._.el.$destinationLatitude.val("");
            this._.el.$destinationLongitude.val("");
            if (typeof(destinationDataField) != "undefined")
            {
                $(destinationDataField).val("");
            }
            // Update the latitude and longitude fields if they exist
            if (typeof(this._.el.$destinationLatitude) != "undefined")
            {
                this._.el.$destinationLatitude.val("");
            }
            if (typeof(this._.el.$destinationLongitude) != "undefined")
            {
                this._.el.$destinationLongitude.val("");
            }
        }

        if (originValue && destinationValue)
        {
            // Get the directions
            formElem.calcRoute();
        }
        else
        {
            // Clear the directions pending flag
            this.clearDirectionsPendingFlag();

            // Clear the directions from the map
            this._.mapItem.polyline.routePolyline.setMap(null);

            // Clear the route data
            if (typeof(routeDataField) != "undefined")
            {
                $(routeDataField).val("");
            }
        }
      },
    
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.getInstance();
        
        // Display the results
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof(originDataField) != "undefined")
        {
            $(originDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
        }
        // Update the latitude and longitude fields if they exist
        if (typeof(map._.el.originLatitude) != "undefined")
        {
            map._.el.$originLatitude.val(map._.mapItem.marker.originMarker.getPosition().lat());
        }
        if (typeof(map._.el.originLongitude) != "undefined")
        {
            map._.el.$originLongitude.val(map._.mapItem.marker.originMarker.getPosition().lng());
        }

        // Finally, clear the origin pending flag to allow form submission
        map.clearOriginDecodePendingFlag();
    },
    
    geocodeDestination : function(results, status) {
        var map = Rootless.Map.getInstance();
        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);
        // Send the geocoded information to the server
        if (typeof(destinationDataField) != "undefined")
        {
            $(destinationDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
        }
        // Update the latitude and longitude fields if they exist
        if (typeof(map._.el.destinationLatitude) != "undefined")
        {
            map._.el.$destinationLatitude.val(map._.mapItem.marker.destinationMarker.getPosition().lat());
        }
        if (typeof(map._.el.destinationLongitude) != "undefined")
        {
            map._.el.$destinationLongitude.val(map._.mapItem.marker.destinationMarker.getPosition().lng());
        }

        // Finally, clear the destination pending flag to allow form submission
        map.clearDestinationDecodePendingFlag();
    },
    
    showResults : function(results, status, marker) {
        if (! results) {
            alert("Geocoder did not return a valid response");
        } else {
            if (status == google.maps.GeocoderStatus.OK) {
                var myLatLng = results[0].geometry.location;
                marker.setPosition(myLatLng);
                marker.setMap(Rootless.Map.getInstance()._.MapObject);
                Rootless.Map.getInstance()._.MapObject.panTo(myLatLng);
            } else {
                // There was a problem with the geocoding
            }
       }
    },
    
    calcRoute : function() {
      var map = Rootless.Map.getInstance();
      var start = map._.el.$originTextBox.val();
      var end = map._.el.$destinationTextBox.val();
      var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.DRIVING
      };
      map._.directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {

            // Set the route field to the results object for posting to the
            // server
            if (typeof(routeDataField) != "undefined")
            {
                $(routeDataField).val(formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(result)));
            }

            // Display the directions
            map._.mapItem.polyline.routePolyline.setPath(result.routes[0].overview_path);
            map._.mapItem.polyline.routePolyline.setMap(map._.MapObject);
            map._.MapObject.fitBounds(result.routes[0].bounds);
        }
        // Finally, clear the directions pending flag to allow form submission
        map.clearDirectionsPendingFlag();
      });
    },
    
    /**
     * Verifies a form can be submitted and is not blocked
     * @returns bool True, if the form can be submitted. False, if the form is blocked.
     */
    canSubmitForm : function(){
        return !this._.formBlock.isOriginDecodePending && !this._.formBlock.isDestinationDecodePending && !this._.formBlock.isDirectionsPending;
    }
    
    
   
   
    
});

Class.addSingleton(Rootless.Map);