/*
 * Request Map Class
 * @constructor Rootless.Map.Request
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Search');

Rootless.Map.Search = Rootless.Map.extend({

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
        
         $('#loader').hide();

            // Handler for the find button
            $('#rides_find').click(function(){
                 $('#loader').show();
                 $('#results').toggle('blind');
                self.ClearPolylinesFromMap();
              });
              
             $('#rideSearchForm').submit(function(){
                 // Set the form submit flag
                 self._.formBlock.isFormSubmitPending = true;
                
                 // Disable the default submission. We will let AJAX do it
                 self.MaybeSubmitForm();
                 return false;
             });
        
        
        // Set textboxes to match the query string variables
        var origin = self.getParameterByName('rides\\[origin]');
        var destination = self.getParameterByName('rides\\[destination]');
            
        if (origin != null) {
        	this._.el.$originTextBox.val(origin);
        }
        
        if (destination != null) {
        	this._.el.$destinationTextBox.val(destination);
        }
            
        if (origin != null || destination != null) {
            this.previewRoute();
            $('#rides_find').click();
        }    
	},
	
	 geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Search.getInstance();
        // Display the results
        
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof(map._.el.originDataField) != "undefined")
        {
            map._.el.originDataField.val(map.formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
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
    	var map = Rootless.Map.Search.getInstance();

        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);
        // Send the geocoded information to the server
        if (typeof(destinationDataField) != "undefined")
        {
            map._.el.destinationDataField.val(map.formatGoogleJSON(strangeLat, strangeLon, JSON.stringify(results[0])));
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
    
    // Form submit options used for the ajax form
    formAjaxOptions : {
            target: '#results',
            success: function()
            {
            	var map = Rootless.Map.Search.getInstance();
                // Clear the form submit pending flag
                isFormSubmitPending = false;

                // This handler function will run when the form is complete
                $('#loader').hide();
                $('#results').show('blind');

                // Add the results to the google map
                map.LoadItemsIntoGoogleMap();

                // Change the hover style
                $("#rideTable tbody tr")
                .hover(function(){
                       map.HighlightRow($(this));
                    }, function() {
                       map.UnHighlightRow($(this));
                    })
                .find('td:not(:has(:checkbox, a))')
                    .click(function () {
                    window.location = $(this).parent().find("a").attr("href");
                });
            }
       },

		
	getParameterByName : function(name) {
    	var queryString = window.location.search;
        queryString = decodeURIComponent(queryString);
        var match = RegExp('[?&]' + name + '=([^&]*)')
        	.exec(queryString);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    },


    HighlightRow : function(tableRow) {
    	tableRow.addClass("rideListSelectedRow");
    	var map = Rootless.Map.Search.getInstance();
        // Get the polyline from the row
        tableRow.find(".routePolyline").each(function(index) {
        	var key = $(this).attr('id');
            polyline = map._.mapItem.polyline.polylines[key];
            map.HighlightPolyline(polyline);
        });
    },
        
    UnHighlightRow: function(tableRow) {
    	tableRow.removeClass("rideListSelectedRow");
    	var map = Rootless.Map.Search.getInstance();
        // Get the polyline from the row
        tableRow.find(".routePolyline").each(function(index) {
        	var key = $(this).attr('id');
        	polyline = map._.mapItem.polyline.polylines[key];
            map.UnHighlightPolyline(polyline);
        });
    }, 
      
    DoNav : function(theUrl) {
            document.location.href = theUrl;
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
        
    LoadItemsIntoGoogleMap : function() {
    	var self = this;
    	$(".routePolyline").each(function(index) {
        	var key = $(this).attr('id');
            var encodedPolyline = $(this).text();
            // Load the polylines into the google map
            var polyline = self.displayEncodedPolyline(self._.MapObject, encodedPolyline, true);
            self._.mapItem.polyline.polylines[key] = polyline;
        });
            
	},
        
   	ClearPolylinesFromMap : function() {
   		var self = this;

    	for (var polyline in self._.mapItem.polyline.polylines) {
        	// Clear the polyline from the google map
           	self._.mapItem.polyline.polylines[polyline].setMap(null);
           	// Remove the polyline from the list of lines
           	delete self._.mapItem.polyline.polylines[polyline];
        }
    }, 
    
    HighlightPolyline : function(polyline) {
    	var map = Rootless.Map.Search.getInstance();
  		polyline.setOptions({strokeColor: map._.CONST.SECONDARY_ROUTE_COLOR, zIndex: 100, strokeOpacity: map._.CONST.SECONDARY_ROUTE_OPACITY});
	},
        
    UnHighlightPolyline : function(polyline) {
    	var map = Rootless.Map.Search.getInstance();
  		polyline.setOptions({strokeColor: map._.CONST.PRIMARY_ROUTE_COLOR, zIndex: 1});
	},

        
	MaybeSubmitForm : function() {            
       // Check to make sure nothing is blocking submitting the form
       if (this.canSubmitForm() && this._.formBlock.isFormSubmitPending) {
            $('#rideSearchForm').ajaxSubmit(this.formAjaxOptions);
        }
     }
    
});

Class.addSingleton(Rootless.Map.Search);