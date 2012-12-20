/*
 * Negotaiation Map Class
 * @constructor Rootless.Map.Negotation
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Negotiation');

Rootless.Map.Negotiation = Rootless.Map.extend({
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
               $originTextBox        : $("#seats_route_origin"),
               $destinationTextBox   : $("#seats_route_destination"),
               originTextBox         : "#seats_route_origin",
               destinationTextBox    : "#seats_route_destination",
               $rideDeleteForm       : $("#rideDeleteForm"),
               $seatRequestForm      : $("#seatRequestForm"),
               $seatDetailsBlock     : $("#seatDetailsBlock"),
               $seatEditBlock        : $("#seatEditBlock"),
               $seatDetails          : $("#seatDetails"),
               $originDataField      : $("#seats_route_origin_data"),
               originDataField       : "#seats_route_origin_data",
               $destinationDataField : $("#seats_route_destination_data"),
               destinationDataField  : "#seats_route_destination_data",
               routeDataField        : "#seats_route_route_data",
               $seatRouteId          : $("#seats_route_route_id"),
               $dynamicDetailsLink   : $(".dynamicDetailsLink"),
               $declinedDetailsLink  : $(".declinedlinks"),
               $acceptedDetailsLink  : $(".acceptedlinks"),
               $riderListItem        : $(".riderListItem"),
               //note: the following two elements are named the same in _offerForm and in the seat negotiation... not sure if this will create a problem. -russ
               $seatsPickupDate      : $("#seats_pickup_date"),
               $seatsPickupTime      : $("#seats_pickup_time"),
               
               //ride offer & request X
               $negotiationBox       : $("#negotiationBox"),
               
               //view my Request
               viewMyRequestBtn      : '.viewMyRequestBtn',
     
               
               //negotiation steps
               negotiationBox           : "#negotiationBox",
               $startNegotiationBtn     : $("#startNegotiation"),
               $mainRidePeople          : $("#mainRidePeople"),
               $mainRideDetails         : $("#mainRideDetails"),
               $rideDetails1NextButton  : $("#rideDetails1NextButton"),
               $rideDetails2NextButton  : $("#rideDetails2NextButton"),
               $rideDetails2BackButton  : $("#rideDetails2BackButton"),
               $dualPostButtonNo        : $("#dualPostButtonNo"),
               $dualPostButtonYes       : $("#dualPostButtonYes"),
               $discussBackButton       : $("#discussBackButton"),
               negotiationSubmit        : ".newSeatForm",
               $backToDashboardButton       : $("#confirmationBackButton"),
               
                
               //form ajax elements
               temporaryNewSeatHolder       : "#temporaryNewSeatHolder",
               seatNegotiationHistoryList   : "#seatNegotiationHistoryList",
               negotiationSpinner           : "#negotiationSpinner",
               $informationContainer        : $('#informationContainer'),
               
               //seatHistoryToggle
               seatHistoryToggle            : "#seatHistoryToggle",
               seatHistoryBlock             : "#seatHistoryBlock",
               
               //seatDetailsEdit
               seatEditButton              : "#editButton",
               saveTermsButton             : "#saveTermsButton",
               cancelTermsButton           : "#cancelTermsButton",
               seatRemoveButton            : '.removeBtn',
               
               //form Accept/Decline buttons
               declineButton         : "#declineButton",
               acceptButton          : "#acceptButton"
               
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
            myOptions);
        self.directionsDisplay.setMap(self._.MapObject);
        
        
        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        self._.mapItem.marker.originMarker = self.initializeMarker("Origin");
        self._.mapItem.marker.destinationMarker = self.initializeMarker("Destination");

	// Decode the polyline for the route
        self._.mapItem.polyline.routePolyline = self.displayEncodedPolyline(self._.MapObject, self._.mapItem.polyline.encodedPolyline, true);
        
        //center the map on the route
        self.centerOnRoute();
        
        self._.mapItem.polyline.routePolyline = self.initializePath()
        
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

        if ($(self._.el.viewMyRequestBtn).length != 0) {
        	$(self._.el.viewMyRequestBtn).bind('click', self.loadSeatDetails);
        } else if (self._.el.$startNegotiationBtn.length != 0) {
        	self.negotiationInit();
        }
        
        self._.el.$dynamicDetailsLink.click(self.loadSeatDetails);
        self._.el.$declinedDetailsLink.click(self.loadSeatDetails);
        self._.el.$acceptedDetailsLink.click(self.loadSeatDetails);
        
        // Bind the ride click buttons
        self._.el.$rideDeleteForm.submit(function(){
            // Confirm the user wants to delete the post
            var confirmed = confirm("Are you sure you want to delete this ride?");
            if (confirmed==true) {
                // Submit the form
                return true;
            } else {
                // Cancel the form submit
                return false; 
            }
        });
     
         
        // If the window url hash is set load that seat's details
        if (window.location.hash != "") {
            var hash = window.location.hash;
            $(hash).trigger('click');
            return false;
        }
        
       
	     self._.el.$riderListItem.hover(function() {
	         self.hoverOverPassenger($(this));
	     }, function() {
	         self.hoverOutPassenger($(this));
	     });
        
        
        $(self._.el.originTextBox).change(self.clearRouteId);
        $(self._.el.destinationTextBox).change(self.clearRouteId);
    },
    
    negotiationInit : function() {
     	var self = this;
     	self.stepCount = 6;
     	self.currentStep = 1;

     	self._.el.$startNegotiationBtn.bind('click', self.loadSeatDetails);
     	self._.el.$rideDetails1NextButton.live('click', self.step);
     	self._.el.$rideDetails2NextButton.live('click', self.step);
     	self._.el.$rideDetails2BackButton.live('click', self.prevStep);
     	self._.el.$discussBackButton.live('click', self.prevStep);
     	self._.el.$dualPostButtonNo.live('click', function() {
     		self.step(true);
     	});
     	self._.el.$dualPostButtonYes.live('click', self.step);
         
        //offer request form X
        self._.el.$seatDetails.prepend('<div class="removeBtn">X</div>');
        $(self._.el.seatRemoveButton).bind('click', self.emptyBlock);
        
        //back to rides button
        self._.el.$backToDashboardButton.live('click', self.backToDashboard);
        
    },
    
    backToRides : function (){
        window.location = sf.url_for('ride', { });
    },
    
    backToDashboard : function (){
        window.location = sf.url_for('dashboard', { });
    },
   
    step : function (b_skip) {
        var map = Rootless.Map.Negotiation.getInstance();
        map._.el.$seatDetails.show();
        
    	$(map._.el.negotiationBox).children().eq(map.currentStep-1).hide();
    	
    	if (b_skip == true) {
    		map.currentStep++;
    	}
    	
        $(map._.el.negotiationBox).children().eq(map.currentStep).fadeIn();
   	    
        map.currentStep++;
        if (map.currentStep==6){
          $(map._.el.seatRemoveButton).hide();
        }
        return false;
   	    
    },
   
    prevStep : function() {
   	   var map = Rootless.Map.Negotiation.getInstance();
   	   $(map._.el.negotiationBox).children().eq(map.currentStep-1).hide();
   	   
   	   $(map._.el.negotiationBox).children().eq(map.currentStep-2).fadeIn();
   	   map.currentStep--;
    },
   
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Negotiation.getInstance();
        // Display the results
        
        map.showResults(results, status, map._.mapItem.marker.originMarker);
        // Send the geocoded information to the server
        if (typeof($(map._.el.originDataField)) != "undefined") {
            $(map._.el.originDataField).val(map.formatGoogleJSON(map.strangeLat, map.strangeLon, JSON.stringify(results[0])));
        }

        // Finally, clear the origin pending flag to allow form submission
        map.clearOriginDecodePendingFlag();
    },
    
    geocodeDestination : function(results, status) {
    	var map = Rootless.Map.Negotiation.getInstance();

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
    
    formAjaxOptions : {
    	
	    // The resulting html should be sent to the test div
	    target: '#temporaryNewSeatHolder',
	    // The callback function when the form was successfully submitted
	    success: function(response) {
	    	var map = Rootless.Map.Negotiation.getInstance();
	        // Move the resulting html from the temporaryNewSeatHolder
	        // to the actual seat history list.
	        $(map._.el.seatNegotiationHistoryList).prepend(response);
	        
	        $(location.hash).trigger('click');
	        
	        map._.el.$seatDetailsBlock.unblock();
	        
	        // Hide the spinner
	        $(map._.el.negotiationSpinner).hide();
	        
	        return true;
	    }
	},
	
    loadSeatDetails : function(e) {
        var map = Rootless.Map.Negotiation.getInstance();
        
        if (($(this).parent().hasClass('riderListItem') && !e.isTrigger) || (!$(this).parent().hasClass('selectedUser') && e.isTrigger)) {
            $(this).parent().toggleClass('selectedUser');
            $(this).parent().siblings().removeClass('selectedUser');
        }

        if ($(this).parent().hasClass('selectedUser') || $(this).hasClass('cta') || $(this).hasClass('.declinedlinks')) {
	        $.ajax({
	        	url : $(this).attr("href"), 
	        	success : function(response, status){
	        		if (status == 'success') {
	        			map._.el.$seatDetails.empty();
	                    //hide main ride details & main ride people info
	                    map._.el.$mainRideDetails.hide();
	                    map._.el.$mainRidePeople.hide();
	                    map.currentStep = 1;
	                    //show seat details
	                    map._.el.$seatDetails.append($(response)[$(response).length - 1]);
	                    map._.el.$seatDetails.show();
                            map._.el.$seatDetails.prepend('<div class="removeBtn">X</div>');
	                    $(map._.el.seatRemoveButton).bind('click', map.emptyBlock);              
                            $(map._.el.seatEditButton).bind('click', map.seatEditButton);
                            $(map._.el.declineButton).bind('click', map.submitForm);
                            $(map._.el.acceptButton).bind('click', map.submitForm);
	                    map.bindTextBoxesToMap();
                            
                            //attach pickers
                            $('.datePicker').datepicker();
                            $('.timePicker').timepicker({ampm: true});
                            
	                    if(this.url.match(/new/)) {
	                         $(map._.el.originTextBox).trigger('change');
                             $(map._.el.destinationTextBox).trigger('change');
                             
                             $(map._.el.negotiationSubmit).ajaxForm({
        	                     beforeSubmit : function() {
        	                     	map._.el.$seatDetails.block({ 
                                        message: '<img src="/images/ajax-loader.gif" alt="Submitting..." />'
                                     });
        	                     },
        	                     
        	                     error : function(response) {
        	                         alert('something is wrong, solo');
        	                         map._.el.$seatDetails.unblock();
        	                        
        	                     },
        	                     
        	                     success : function() {
        	                         map._.el.$seatDetails.unblock();
        	                         map.step();
        	                     }
                             });
	                    }
	                    
	                    
	                    //bind seat histoy toggle
	                    $(map._.el.seatHistoryToggle).bind('click', map.seatHistoryToggle);
	                    
	                    if (e.isTrigger) {
        	                $(map._.el.seatHistoryToggle).trigger('click');
                        }
	                }
	            }
	        });
	        // Set the # in the url to keep track of which seat was clicked
	        window.location.hash = $(this).attr('id');
	        return false;
        } else {
        	$(map._.el.seatRemoveButton).trigger('click');
        	window.location.hash = '';
        	return false;
        }

        // Return false to override default click behavior
        return false;
    },
    
    emptyBlock: function () {
    	var map = Rootless.Map.Negotiation.getInstance();
    	
        var url = $(this).hasClass('removeBtn') ? '' : window.location.hash;

    	$(this).closest('#seatDetails').empty();
    	map._.el.$riderListItem.removeClass('selectedUser');

        if (url != '') {
            $(url).trigger('click');	
        } else {
        	map._.el.$mainRideDetails.show();
	        map._.el.$mainRidePeople.show();
        	window.location.hash = url;
        }
        
    	return false;
    },
    
    saveTerms: function() {
    	var map = Rootless.Map.Negotiation.getInstance();
    	$(this).closest('form').ajaxSubmit(map.formAjaxOptions);
    	return false;
    },
    
    submitForm : function(e) {
    	var map = Rootless.Map.Negotiation.getInstance();
    	$(this).closest('form').ajaxSubmit();
    	$(map._.el.seatRemoveButton).trigger('click');
    	location.reload(true);
    	return false;
    },
    
    clearRouteId : function() {
        // Clear the route id
        Rootless.Map.Negotiation.getInstance()._.el.$seatRouteId.val('');
    },
    
    maybeSubmitForm : function() {
    	var self = Rootless.Map.Negotiation.getInstance();            
	    // Check to make sure nothing is blocking submitting the form
	    if (self.canSubmitForm() && self._.formBlock.isFormSubmitPending) {
	        self._.el.$seatRequestForm.ajaxSubmit(self.formAjaxOptions);
	    } 
    },
    
    seatHistoryToggle : function() {
        var map = Rootless.Map.Negotiation.getInstance();
        $(this).toggleClass('open');
        
        var text = $(this).hasClass('open') ? 'Hide Discussion History' : 'See Discussion History';
        $(this).html(text);
        
        $(map._.el.seatHistoryBlock).toggle();
    },
    
    seatEditButton : function(){
        var map = Rootless.Map.Negotiation.getInstance();
 
	    $.ajax({
	         url : $(this).parent().attr("action"), 
	         success : function(response, status){
	             if (status == 'success') {
	                 map._.el.$seatDetails.empty();
	                 //hide main ride details & main ride people info
	                 map._.el.$mainRideDetails.hide();
	                 map._.el.$mainRidePeople.hide();	

	                 map._.el.$seatDetails.append($(response)[$(response).length - 1]);
	                 map._.el.$seatDetails.show();
	                 map._.el.$seatDetails.prepend('<div class="removeBtn">X</div>');
	                 
	                 $(map._.el.seatRemoveButton).bind('click', map.emptyBlock);
	                 $(map._.el.cancelTermsButton).bind('click', map.emptyBlock);
	                 $(map._.el.saveTermsButton).bind('click', map.saveTerms);
   
	                 //show seat edit
	                 map._.el.$seatEditBlock.show();
	                 map.bindTextBoxesToMap();
                         //attach pickers
                         $('.datePicker').datepicker();
                         $('.timePicker').timepicker({ampm: true});
	                 //bind seat histoy toggle
	                 $(map._.el.seatHistoryToggle).bind('click', map.seatHistoryToggle);
	                 return false;
	                
	             }
	        }
	    });
	    return false;
   }
});

Class.addSingleton(Rootless.Map.Negotiation);
