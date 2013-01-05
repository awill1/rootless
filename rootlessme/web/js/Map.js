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
           
           MapObject : undefined,
           //all html elements referred in the code should go here (including jquery)
           el : {
               $originTextBox        : $("#rides_origin"),
               $destinationTextBox   : $("#rides_destination"),
               originTextBox         : "#rides_origin",
               destinationTextBox    : "#rides_destination"
           },
           
           // Variables used to block form submitting before map api results are returned
            formBlock : {
                isOriginDecodePending      : false,
                isDestinationDecodePending : false,
                isDirectionsPending        : false,
                isReturnDirectionsPending  : false,
                isFormSubmitPending        : false
            },
           
           //map markers and polylines should be here
           mapItem : {
                polyline : {
                	polylines : []
                },
                
                marker : {
                    
                }
           }
           
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
       	   scrollwheel: false,
           zoom: self._.CONST.MAP_DEFAULT_ZOOM,
           center: latlng,
           mapTypeId: google.maps.MapTypeId.ROADMAP
       };
      
        self._.MapObject = new google.maps.Map(document.getElementById(self._.mapId),
            myOptions);
        self._.directionsDisplay.setMap(self._.MapObject);
        
        this.directionsService = new google.maps.DirectionsService();
        this.geocoder          = new google.maps.Geocoder();
       	this.directionsDisplay = new google.maps.DirectionsRenderer();

        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        self._.mapItem.marker.originMarker = self.initializeMarker("Origin");
        self._.mapItem.marker.destinationMarker = self.initializeMarker("Destination");
        // Setup the path, the maps are null because the path is hidden
        self._.mapItem.polyline.routePolyline = self.initializePath();
        
        // Route preview changes whenever the user finished editing the
        // origin or destination textboxes
        self.bindTextBoxesToMap();
   },
   
    /**
     * formatGoogleJSON is used to change the strange keys used for 
     * latitude and longitude into easier to use "lat" and "lon" keys.
     * The quotes must be included or else we could replace unexpected 
     * pieces of the string such as street name or encoded polyline
     */
    formatGoogleJSON: function(strangeLat, strangeLon, jsonString) {
       // Build the regular expressions, and return the replacement
       var strangeLatRegExp = new RegExp("\""+strangeLat+"\"","g");
       var strangeLonRegExp = new RegExp("\""+strangeLon+"\"","g");
       return jsonString.replace(strangeLatRegExp,"\"lat\"")
                        .replace(strangeLonRegExp, "\"lon\"");
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
    	var self = this;
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
   
        if ($(this._.el.originTextBox).text) {
	        $(this._.el.originTextBox).tipsy({
	        	gravity : 'w',
	        	title   : 'original-title',
	        	trigger : 'focus',
	        	html    : false,
	        	live    : true,
	        	offset  : 15,
	        	opacity : 1
	        });
        
        }
        
        if ($(this._.el.destinationTextBox).text) {
	        $(this._.el.destinationTextBox).tipsy({
	        	gravity : 'w',
	        	title   : 'original-title',
	        	trigger : 'focus',
	        	html    : false,
	        	live    : true,
	        	offset  : 15,
	        	opacity : 1
	        });
        }
        // Route preview changes whenever the user finished editing the
        // seat pickup and dropoff textboxes
        $(this._.el.originTextBox).bind('change', function() {self.previewRoute($(self._.el.originTextBox))});
        $(this._.el.destinationTextBox).bind('change', function() {self.previewRoute($(self._.el.destinationTextBox))});
    },
    
    /**
     * Clears the origin decode flag used to block form submission before
     * the map api returns
     */
     clearOriginDecodePendingFlag : function() {
        // Clear the flag
        this._.formBlock.isOriginDecodePending = false;
        // Submit the form if necessary and if the function is defined
        if (typeof(this.MaybeSubmitForm) == typeof(Function)) {
           this.MaybeSubmitForm();
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
        if (typeof(this.MaybeSubmitForm) == typeof(Function)) {
            this.MaybeSubmitForm();
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
            this.MaybeSubmitForm();
        }
     },
     
    /**
     * Clears the return directions pending flag used to block form submission before
     * the map api returns
     */
     clearReturnDirectionsPendingFlag : function() {
        // Clear the flag
        this._.formBlock.isReturnDirectionsPending = false;
        // Submit the form if necessary and if the function is defined
        if (typeof(MaybeSubmitForm) == typeof(Function)) {
            this.MaybeSubmitForm();
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
        this._.formBlock.isReturnDirectionsPending = true;

        var originValue = $(this._.el.originTextBox).val();
        if (originValue){
            // Get the location of the origin, and place a marker on the map
            var originGeocodeRequest = {
                address: originValue
            };
            
            this.geocoder.geocode(originGeocodeRequest, self.geocodeOrigin);
        } else {
            // Clear the origin pending flag
            this.clearOriginDecodePendingFlag();

            // There is no origin so clear the marker from the map
            this._.mapItem.marker.originMarker.setMap(null);
            
            if (typeof($(self._.el.originDataField)) != "undefined")
            {
                $(self._.el.originDataField).val("");
            }
            // Clear the latitude and longitude fields if they exist
            if (typeof($(this._.el.originLatitude)) != "undefined")
            {
                $(this._.el.originLatitude).val("");
            }
            if (typeof($(this._.el.originLongitude)) != "undefined")
            {
                $(this._.el.originLongitude).val("");
            }
        }

        var destinationValue = $(this._.el.destinationTextBox).val();
        if (destinationValue)
        {
            // Get the location of the destination, and place a marker on the map
            var destinationGeocodeRequest = {
                address: destinationValue
            };
            
            this.geocoder.geocode(destinationGeocodeRequest, self.geocodeDestination);
        } else {
            // Clear the destination pending flag
            this.clearDestinationDecodePendingFlag();

            // There is no destination so clear the marker from the map
            this._.mapItem.marker.destinationMarker.setMap(null);
            
            if (typeof($(this._.el.destinationDataField)) != "undefined")
            {
                $($(this._.el.destinationDataField)).val("");
            }
            // Update the latitude and longitude fields if they exist
            if (typeof($(this._.el.destinationLatitude)) != "undefined")
            {
                $(this._.el.destinationLatitude).val("");
            }
            if (typeof(this._.el.$destinationLongitude) != "undefined")
            {
                $(this._.el.destinationLongitude).val("");
            }
        }

        if (originValue && destinationValue)
        {
            // Get the directions
            this.calcRoute(formElem);
        }
        else
        {
            // Clear the directions pending flag s
            this.clearDirectionsPendingFlag();
            this.clearReturnDirectionsPendingFlag();
            
            // Clear the directions from the map
            this._.mapItem.polyline.routePolyline.setMap(null);

            // Clear the route data
            if (typeof($(this._.el.routeDataField)) != "undefined")
            {
                $(this._.el.routeDataField).val("");
            }
            // Clear the return route data
            if (typeof($(this._.el.returnRouteDataField)) != "undefined")
            {
                $(this._.el.returnRouteDataField).val("");
            }
            
            // Clear the route polyline field 
            if (typeof($(this._.el.polyline)) != "undefined")
            {
                $(this._.el.polyline).val("");
            }
            // Clear the return route polyline field 
            if (typeof($(this._.el.returnPolyline)) != "undefined")
            {
                $(this._.el.returnPolyline).val("");
            }
        }
      },
      
     displayEncodedPolyline : function (map, encodedPolyline, isPrimary) {
	   // Decode the polyline for the route
	    var routeCoordinates  = google.maps.geometry.encoding.decodePath(encodedPolyline);
	    
	    if (isPrimary == true) {
	      var routePath = this.createPrimaryPolyline(routeCoordinates);
	    } else {
	      var routePath = this.createNonPrimaryPolyline(routeCoordinates);
	    }
	
	    // Bind the polyline to the map
	    routePath.setMap(map);
	    
	    // Return the created polyline
	    return routePath;
    },
    
    showResults : function(results, status, marker) {

        if (! results) {
            alert("Geocoder did not return a valid response");
        } else {
            if (status == google.maps.GeocoderStatus.OK) {
     
                var myLatLng = results[0].geometry.location;
                marker.setPosition(myLatLng);
                marker.setMap(this._.MapObject);
                this._.MapObject.panTo(myLatLng);
            } else {
                // There was a problem with the geocoding
            }
       }
    },
    
    calcRoute : function(formElem) {
        var self = this;
        var request = {
            origin: $(self._.el.originTextBox).val(),
            destination: $(self._.el.destinationTextBox).val(),
            travelMode: google.maps.TravelMode.DRIVING
        };
        var returnRequest = {
            origin: $(self._.el.destinationTextBox).val(),
            destination: $(self._.el.originTextBox).val(),
            travelMode: google.maps.TravelMode.DRIVING
        };

        this.directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                // Set the route field to the results object for posting to the
                // server
                if (typeof(self._.el.routeDataField) != "undefined")
                {    
                   $(self._.el.routeDataField).val(self.formatGoogleJSON(self.strangeLat, self.strangeLon, JSON.stringify(result)));
                }

                // Display the directions
                self._.mapItem.polyline.routePolyline.setPath(result.routes[0].overview_path);
                self._.mapItem.polyline.routePolyline.setMap(self._.MapObject);
                self._.MapObject.fitBounds(result.routes[0].bounds);

                // Set the route field to the results object for posting to the
                // server
                if (typeof($(self._.el.polyline)) != "undefined")
                {
                    $(self._.el.polyline).val(result.routes[0].overview_polyline.points);
                }
            }
            // Finally, clear the directions pending flag to allow form submission
            self.clearDirectionsPendingFlag();
        });

        // Get the directions for the return trip
        this.directionsService.route(returnRequest, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                // Set the route field to the results object for posting to the
                // server
                if (typeof(self._.el.returnRouteDataField) != "undefined")
                {    
                   $(self._.el.returnRouteDataField).val(self.formatGoogleJSON(self.strangeLat, self.strangeLon, JSON.stringify(result)));
                }

                // Do not display the return route directions

                // Set the route field to the results object for posting to the
                // server
                if (typeof($(self._.el.returnPolyline)) != "undefined")
                {
                    $(self._.el.returnPolyline).val(result.routes[0].overview_polyline.points);
                }
            }
            // Finally, clear the directions pending flag to allow form submission
            self.clearReturnDirectionsPendingFlag();
        });
    },
    
    /**
     * Centers the map on the Route
     */
    centerOnRoute : function() {
    	var self = this;
    	var tempLocHolder = self._.mapItem.polyline.routePolyline.getPath().b;
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < tempLocHolder.length; i++) {
        	bounds.extend(tempLocHolder[i]);
        }
        
        self._.MapObject.fitBounds(bounds);
    },
    	
    hoverOverPassenger : function(passengerItem) {
		self = this;
        // Get the polyline from the row
        var item = passengerItem.find(".routePolyline");
        var key = item.attr('id');
        var polyline = self._.mapItem.polyline.polyLineObj[key];
        
        self.highlightPolyline(polyline);
    },

    hoverOutPassenger : function(passengerItem) {
   	   var self = this;
       // Get the polyline from the row
       var item = passengerItem.find(".routePolyline");
       var key = item.attr('id');
       var polyline = self._.mapItem.polyline.polyLineObj[key];

        if (!(item.hasClass('pendingLine'))) {
            self.passengerUnHighlightPolyline(polyline);
        } else {
            self.pendingUnHighlightPolyline(polyline);
        }
    },
    
    highlightPolyline : function(polyline) {
    	var self = this;
        polyline.setOptions({strokeColor: self._.CONST.SECONDARY_ROUTE_COLOR, zIndex: 100, strokeOpacity:  self._.CONST.SECONDARY_ROUTE_OPACITY});
    },
        
    unHighlightPolyline : function(polyline) {
        var self = this;
        polyline.setOptions({strokeColor: self._.CONST.PRIMARY_ROUTE_COLOR, zIndex: 1});
    },
	
    passengerUnHighlightPolyline : function(polyline) {
        var self = this;
        polyline.setOptions({strokeColor: self._.CONST.SECONDARY_ROUTE_COLOR, zIndex: -1});
    },
   
    pendingUnHighlightPolyline : function(polyline) {
        var self = this;
        polyline.setOptions({strokeColor: self._.CONST.SECONDARY_ROUTE_COLOR, zIndex: -1, strokeOpacity: 0 });
    },

    /**
     * Verifies a form can be submitted and is not blocked
     * @returns bool True, if the form can be submitted. False, if the form is blocked.
     */
    canSubmitForm : function(){
        return !this._.formBlock.isOriginDecodePending && !this._.formBlock.isDestinationDecodePending && !this._.formBlock.isDirectionsPending;
    },
    
    /**
     * Tries to submit the form. It will only be submitted if none of the
     * blocking flags are set.
     */
    MaybeSubmitForm : function() {            
       //left this blank to show that this function in used in almost all classes but the function changes based on form
    }
    
    
   
   
    
});

Class.addSingleton(Rootless.Map);
