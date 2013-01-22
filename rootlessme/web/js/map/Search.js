/*
 * Search Map Class
 * @constructor Rootless.Map.Request
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Search');

Rootless.Map.Search = Rootless.Map.extend({
    /**
     *  Initializes the Google Maps API for Searches
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
                originTextBox         : "#rides_origin",
                $destinationTextBox   : $("#rides_destination"),
                destinationTextBox    : "#rides_destination",
                polyline              : "#rides_polyline",
                originLatitude        : "#rides_origin_latitude",
                originLongitude       : "#rides_origin_longitude",
                destinationLatitude   : "#rides_destination_latitude",
                destinationLongitude  : "#rides_destination_longitude",
                $loader               : $('#loader'),
                $ridefind             : $('#rides_find'),
                $results              : $('#results'),
                $rideSearchForm       : $('#rideSearchForm')
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
    
        self.setLatLng();
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
            myOptions);
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
        
        //elements used on ride search pages
        
        
        self._.el.$loader.hide();

        // Handler for the find button
        self._.el.$ridefind.click(function(){
            self._.el.$loader.show();
            self._.el.$results.toggle('blind');
        });
              
        self._.el.$rideSearchForm.submit(function(){
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
            
    },
	
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Search.getInstance();
        // Display the results
        map.showResults(results, status, map._.mapItem.marker.originMarker);

        // Update the latitude and longitude fields if they exist
        if (typeof($(map._.el.originLatitude)) != "undefined")
        {
            $(map._.el.originLatitude).val(map._.mapItem.marker.originMarker.getPosition().lat());
        }
        if (typeof($(map._.el.originLongitude)) != "undefined")
        {
            $(map._.el.originLongitude).val(map._.mapItem.marker.originMarker.getPosition().lng());
        }

        // Finally, clear the origin pending flag to allow form submission
        map.clearOriginDecodePendingFlag();
    },
    
    geocodeDestination : function(results, status) {
    	var map = Rootless.Map.Search.getInstance();

        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);

        // Update the latitude and longitude fields if they exist
        if (typeof($(map._.el.destinationLatitude)) != "undefined")
        {
             $(map._.el.destinationLatitude).val(map._.mapItem.marker.destinationMarker.getPosition().lat());
        }
        if (typeof($(map._.el.destinationLongitude)) != "undefined")
        {
             $(map._.el.destinationLongitude).val(map._.mapItem.marker.destinationMarker.getPosition().lng());
        }

        // Finally, clear the destination pending flag to allow form submission
        map.clearDestinationDecodePendingFlag();
    },
    
    handleNoGeolocation : function(errorFlag) {
        if (errorFlag == true) {
            alert("Geolocation service failed.");
        } else {
            alert("Your browser doesn't support geolocation. We will show the default map view.");
        }
    },
    
    setLatLng : function() {
    	var self = this;
        var browserSupportFlag;
        
        if(navigator.geolocation) {
            browserSupportFlag = true;
       	    navigator.geolocation.getCurrentPosition(function(position) {
       	        self._.CONST.MAP_DEFAULT_LATITUDE = position.coords.latitude;
       	        self._.CONST.MAP_DEFAULT_LONGITUDE = position.coords.longitude;
       	        var latlng = new google.maps.LatLng(self._.CONST.MAP_DEFAULT_LATITUDE, self._.CONST.MAP_DEFAULT_LONGITUDE);
       	        self._.MapObject.setCenter(latlng);
       	        self._.MapObject.setZoom(9);
       	        var marker = new google.maps.Marker({ 
       	        	position: latlng,
                    map: self._.MapObject,
                    icon : new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|119D49"),
                });
                self._.mapItem.marker.currentLocation = marker;
                
        	    self.geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        	        self._.el.$originTextBox.val(results[0].formatted_address);
        	        self.previewRoute();  
        	        self._.el.$ridefind.click();
        	        
                });
       	    }, function() {
       	        self.handleNoGeolocation(browserSupportFlag);
       	    });
        } else {
            browserSupportFlag = false;
       	    this.handleNoGeolocation(browserSupportFlag);
        }
    },
    
    // Form submit options used for the ajax form
    formAjaxOptions : {
        target: '#results',
        beforeSubmit : function() {
            // Clear the form submit pending flag
            isFormSubmitPending = false;
            
            // Send an event to google analytics for the form submission
            _gaq.push(['_trackEvent', 'rides', 'searchSubmitted']);
        },
        success: function()
        {
            var map = Rootless.Map.Search.getInstance();

            // This handler function will run when the form is complete
            $('#loader').hide();
            $('#results').show('blind');
            
            map.ClearPolylinesFromMap();

            // Add the results to the google map
            map.LoadItemsIntoGoogleMap();

            // Change the hover style
            $(".rideTable tbody tr")
            .hover(function(){
                   map.HighlightRow($(this));
                }, function() {
                   map.UnHighlightRow($(this));
                }).click(function () {
                window.location = $(this).find('.tableLink').attr("href");
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
