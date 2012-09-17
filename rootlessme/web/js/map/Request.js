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
        self.bindTextBoxesToMap();
        self._.strangeLat;
        self._.strangeLon;
        self._.testPoint = new google.maps.LatLng(23,45);

   },
   
	geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Request.getInstance();
        // Display the results
        
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof(map._.el.originDataField) != "undefined")
        {
            $(map._.el.originDataField).val(map.formatGoogleJSON(map._.strangeLat, map._.strangeLon, JSON.stringify(results[0])));
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
    	var map = Rootless.Map.Request.getInstance();

        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);
        // Send the geocoded information to the server
        if (typeof(destinationDataField) != "undefined")
        {
            $(map._.el.destinationDataField).val(map.formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
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
    
	MaybeSubmitForm : function() {            
       // Check to make sure nothing is blocking submitting the form
       if (this.canSubmitForm() && this._.formBlock.isFormSubmitPending) {
            $('.newRideForm').submit();
        }
     }
    
});

Class.addSingleton(Rootless.Map.Request);