/*
 * Negotiation Ride Offer Map Class
 * @constructor Rootless.Map.Negotation.RideOffer
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Negotiation.RideOffer');

Rootless.Map.Negotiation.RideOffer = Rootless.Map.Negotiation.extend({
	/**
    *  Initializes the Google Maps API for Negotiations
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
               $rideDeleteForm       : $("#rideDeleteForm"),
               $startNegotiationBtn  : $('#startNegotiation'),
               $seatRequestForm      : $('#seatRequestForm'),
               $seatDetailsBlock     : $('#seatDetailsBlock'),
               $negotiationBox       : $('#negotiationBox'),
               $originDataField      : $('#seats_route_origin_data'),
               $destinationDataField : $('#seats_route_destination_data'),
               $routeDataField       : $('#seats_route_route_data'),
               
               $mainRidePeople          : $('#mainRidePeople'),
               $mainRideDetails         : $('#mainRideDetails'),
               $rideDetails1NextButton  : $('#rideDetails1NextButton'),
               $rideDetails2NextButton  : $('#rideDetails2NextButton'),
               $rideDetails2BackButton  : $('#rideDetails2BackButton'),
               $dualPostButtonNo        : $('#dualPostButtonNo'),
               $dualPostButtonYes       : $('#dualPostButtonYes'),
               $discussBackButton       : $('#discussBackButton')
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
           
           },
           
           directionsService : new google.maps.DirectionsService(),
           geocoder          : new google.maps.Geocoder(),
       	   directionsDisplay : new google.maps.DirectionsRenderer()
           
           
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
        
        
        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        self._.mapItem.marker.originMarker = self.initializeMarker("Origin");
        self._.mapItem.marker.destinationMarker = self.initializeMarker("Destination");

		// Decode the polyline for the route
        self._.mapItem.polyline.routePolyline = self.displayEncodedPolyline(self._.MapObject, self._.mapItem.polyline.encodePolyline, true);
        
        //center the map on the route
        self.centerOnRoute();
        
        // Route preview changes whenever the user finished editing the
        // origin or destination textboxes
        self.bindTextBoxesToMap();
        self.strangeLat;
        self.strangeLon;
        self.testPoint = new google.maps.LatLng(23,45);
		
        self.negotiationInit();
		
		// Discover the strange keys used for longitude and latitude
        // in the data returned from google maps api.
        var googleTestString = JSON.stringify(self.testPoint);
        // this is a random two character string which represents latitude
        //  and longitude in the stringified data
        self.strangeLat = googleTestString.substring(2,4);	
        self.strangeLon = googleTestString.substring(10,12);

   },
   
   negotiationInit : function() {
     	var self = this;
     	self.stepCount = self._.el.$negotiationBox.children().length;
     	self.currentStep = 0;
     	self._.el.$startNegotiationBtn.bind('click', self.step);
     	self._.el.$rideDetails1NextButton.bind('click', self.step);
     	self._.el.$rideDetails2NextButton.bind('click', self.step);
     	self._.el.$rideDetails2BackButton.bind('click', self.prevStep);
     	self._.el.$discussBackButton.bind('click', self.prevStep);
     	self._.el.$dualPostButtonNo.bind('click', function() {
     		self.step(true);
     	});
     	self._.el.$dualPostButtonYes.bind('click', self.step);
    },
   
    step : function (b_skip) {
        var map = Rootless.Map.Negotiation.RideOffer.getInstance();
        
        map._.el.$seatDetailsBlock.show();
        
        if (map.currentStep == 0) {
    		map._.el.$mainRidePeople.hide();
    		map._.el.$mainRideDetails.hide();
    	} else if (map.currentStep == map.stepCount) {
    		map._.el.$mainRidePeople.show();
    		map._.el.$mainRideDetails.show();
    		map._.el.$seatDetailsBlock.hide();
    		map.CurrentStep == 0;
    		
    		return true;
    	} else {
    		map._.el.$negotiationBox.children().eq(map.currentStep-1).hide();
    	}
    	
    	if (b_skip == true) {
    		map.currentStep++;
    	}
    	
        map._.el.$negotiationBox.children().eq(map.currentStep).fadeIn();
   	    
        map.currentStep++;
        
        return false;
   	    
    },
   
    prevStep : function() {
   	   var map = Rootless.Map.Negotiation.RideOffer.getInstance();
   	   map._.el.$negotiationBox.children().eq(map.currentStep-1).hide();
   	   
   	   map._.el.$negotiationBox.children().eq(map.currentStep-2).fadeIn();
   	   map.currentStep--;
    },
   
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Negotiation.RideOffer.getInstance();
        // Display the results
        
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof(map._.el.$originDataField) != "undefined") {
            $(map._.el.$originDataField).val(map.formatGoogleJSON(map.strangeLat, map.strangeLon, JSON.stringify(results[0])));
        }

        // Finally, clear the origin pending flag to allow form submission
        map.clearOriginDecodePendingFlag();
    },
    
    geocodeDestination : function(results, status) {
    	var map = Rootless.Map.Negotiation.RideOffer.getInstance();

        // Display the results
        map.showResults(results, status, map._.mapItem.marker.destinationMarker);
        // Send the geocoded information to the server
        if (typeof(map._.el.$destinationDataField) != "undefined")
        {
            $(map._.el.$destinationDataField).val(map.formatGoogleJSON(map.strangeLat, map.strangeLon, JSON.stringify(results[0])));
        }

        // Finally, clear the destination pending flag to allow form submission
        map.clearDestinationDecodePendingFlag();
    },
    
    formAjaxOptions : {
	    // The resulting html should be sent to the test div
	    target: '#temporaryNewSeatHolder',
	    // The callback function when the form was successfully submitted
	    success: function() {
	        // Move the resulting html from the temporaryNewSeatHolder
	        // to the actual seat history list.
	        $('#seatNegotiationHistoryList').prepend($('#temporaryNewSeatHolder').contents());
	
	        $('#seatDetailsBlock').unblock();
	
	        // Hide the spinner
	        $("#negotiationSpinner").hide();
	    }
	},
    
    loadSeatDetails : function() {
    	if($('.selectedUser').length > 0) {
            $('.selectedUser').removeClass('selectedUser');
        }
        
        $(this).parent().append($('#seatSpinnerContainer'));
        $('#seatSpinnerContainer').show();
        $(this).parent().addClass('selectedUser');

        $("#seatNegotiationBlock").slideUp("blind");
        $("#seatNegotiationBlock").load($(this).attr("href"),
        	function(){
            	$('#negotiationSpinnerContainer').hide();
                $("#seatNegotiationBlock").slideDown("blind");
                self.bindTextBoxesToMap();
            });

        // Set the # in the url to keep track of which seat was clicked
        window.location.hash = $(this).attr('id');

        // Return false to override default click behavior
        return false;
    },
    
    clearRouteId : function() {
        // Clear the route id
        $('#seats_route_route_id').val('');
    },
    
	MaybeSubmitForm : function(tar) { 
	   var map = Rootless.Map.Negotiation.RideOffer.getInstance();           
       // Check to make sure nothing is blocking submitting the form
       if (map.canSubmitForm() && map._.formBlock.isFormSubmitPending && tar.attr('id') == 'seatNegotiationForm') {
           $('#seatNegotiationForm').ajaxSubmit(map.formAjaxOptions);
       } else if (map.canSubmitForm() && map._.formBlock.isFormSubmitPending && (tar.attr('id') == 'seatDeclineForm' || tar.attr('id') == 'seatAcceptForm')) {
       	   tar.ajaxSubmit(map.formAjaxOptions);
       }
     }
    
});

Class.addSingleton(Rootless.Map.Negotiation.RideOffer);