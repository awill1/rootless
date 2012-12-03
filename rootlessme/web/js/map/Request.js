/*
 * Request Map Class
 * @constructor Rootless.Map.Request
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Request');

Rootless.Map.Request = Rootless.Map.extend({
	/**
    *  Initializes the Google Maps API for request forms
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
               destinationTextBox    : "#rides_destination",
               $submitButton         : $('.submitButton'),
               $newRideFormArea	     : $("#newRideFormArea")
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
       
       this.directionsService = new google.maps.DirectionsService();
       this.geocoder          = new google.maps.Geocoder();
       this.directionsDisplay = new google.maps.DirectionsRenderer();
      
        self._.MapObject = new google.maps.Map(document.getElementById(self._.mapId),
            myOptions);;
        self.directionsDisplay.setMap(self._.MapObject);

        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        self._.mapItem.marker.originMarker = self.initializeMarker("Origin");
        self._.mapItem.marker.destinationMarker = self.initializeMarker("Destination");
        // Setup the path, the maps are null because the path is hidden
        self._.mapItem.polyline.routePolyline = self.initializePath();
        
        // Route preview changes whenever the user finished editing the
        // origin or destination textboxes
        self.bindTextBoxesToMap();
        self.strangeLat;
        self.strangeLon;
        self.testPoint = new google.maps.LatLng(23,45);
		
		// Discover the strange keys used for longitude and latitude
        // in the data returned from google maps api.
        var googleTestString = JSON.stringify(self.testPoint);
        // this is a random two character string which represents latitude
        //  and longitude in the stringified data
        self.strangeLat = googleTestString.substring(2,4);
        self.strangeLon = googleTestString.substring(10,12);
        
        // Use the safe form submit function incase the google map api has
        // not returned yet
        self._.el.$submitButton.click(function(){
            // Set the form submit flag
             self._.formBlock.isFormSubmitPending = true;
                
             // Block the fragment-vehicles div
             self._.el.$newRideFormArea.block({ 
                  message: 'saving'
             }); 

             // Disable the default submission. We will let the helper 
             // function do it
             self.MaybeSubmitForm();
             return false;
         });
   },
   
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Request.getInstance();
        // Display the results
        
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof($(map._.el.originDataField)) != "undefined")
        {
            $(map._.el.originDataField).val(map.formatGoogleJSON(map.strangeLat, map.strangeLon, JSON.stringify(results[0])));
        }

        // Finally, clear the origin pending flag to allow form submission
        map.clearOriginDecodePendingFlag();
    },
    
    geocodeDestination : function(results, status) {
    	var map = Rootless.Map.Request.getInstance();

        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);
        // Send the geocoded information to the server
        if (typeof($(map._.el.destinationDataField)) != "undefined")
        {
            $(map._.el.destinationDataField).val(map.formatGoogleJSON(map.strangeLat, map.strangeLon, JSON.stringify(results[0])));
        }

        // Finally, clear the destination pending flag to allow form submission
        map.clearDestinationDecodePendingFlag();
    },
    
	MaybeSubmitForm : function() {            
       // Check to make sure nothing is blocking submitting the form
       if (this.canSubmitForm() && this._.formBlock.isFormSubmitPending) {
            $('.newRideForm').submit();
        }
     }
    
});

Class.addSingleton(Rootless.Map.Request);