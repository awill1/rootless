/*
 * Place Map Class
 * @constructor Rootless.Map.Place
 * @params spec <Object> Object that holds all the variables for the maps
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */

Namespace('Rootless.Map.Place');

Rootless.Map.Place = Rootless.Map.extend({
   /**
    *  Initializes the Google Maps API for place forms
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
               $originTextBox                 : $("#originTextBox"),
               $destinationTextBox            : $("#destinationInput"),
               originTextBox                  : "#originTextBox",
               destinationTextBox             : "#destinationInput",
               $submitButton                  : $('.postRideButton'),
               $newRideFormArea	              : $("#newRideFormArea"),
               rideForm                       : "#roundTripForm",
               placeFormBox                   : "#placeFormBox",
               originDataField                : "#originDataInput",
               destinationDataField           : "#destinationDataInput",
               routeDataField                 : "#departureRouteDataInput", 
               returnRouteDataField           : "#returnRouteDataInput",
               anotherRideButton              : "#confirmationPostAnotherRide",
               startDateTextBox               : "#startDateTextBox",
               departureAnyDayCheckbox        : "#startDateAnydayCheckBox",
               returnDateTextBox              : "#returnDateTextBox",
               returnAnyDayCheckbox           : "#returnDateAnydayCheckBox",
               trackableField                 : ".trackableField",
               rideTypeDriver                 : "#rideTypeDriver",
               rideTypePassenger              : "#rideTypePassenger",
               rideTypeEither                 : "#rideTypeEither",
               driverContainer                : "#driverContainer",
               passengerContainer             : "#passengerContainer",
               loginFormDialogContainer       : "#loginFormDialogContainer",
               placeRideContainer             : "#placeRideContainer",
               placeRideConfirmationContainer : "#placeRideConfirmationContainer"
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
        $(self._.el.rideForm).validate({
            invalidHandler: function(form, validator) {
                var numberOfInvalidElements = validator.numberOfInvalids();
                var invalidElements = validator.invalidElements();
                for (var i = 0 ; i < numberOfInvalidElements ; i++)
                {
                    var invalidElementName = invalidElements[i].name;
                    // Send an event to google analytics for the form validation error
                    _gaq.push(['_trackEvent', 'places', 'validationError', invalidElementName]);
                }
            },
            submitHandler: function() {
                // Set the form submit flag
                 self._.formBlock.isFormSubmitPending = true;
                 // Disable the default submission. We will let the helper 
                 // function do it
                 self.MaybeSubmitForm();
            }
        });
         
        // Login form for late login
        var place = Rootless.Map.Place.getInstance();
        var utils = Rootless.Static.Utils.getInstance();
        utils.signInDialogInit(place.MaybeSubmitForm);
        $(place._.el.loginFormDialogContainer).dialog({ autoOpen: false, modal : true, zIndex: 2000});
         
        // Show the place marker by previewing the route
        self.previewRoute($(self._.el.destinationTextBox));
        
        // Show the ride form and hide the confirmation section
        $(place._.el.placeFormBox).show();
        $(place._.el.placeRideConfirmationContainer).hide();
        
        // Add more click handlers
        
        // Anyday checkbox click handlers
        $(self._.el.departureAnyDayCheckbox).click(function(){
            // If the any day checkbox is checked, diable the date picker
            if ($(this).is(':checked')) {
                $(self._.el.startDateTextBox).attr("disabled", "disabled"); 
            } else {
                $(self._.el.startDateTextBox).removeAttr("disabled");
            } 
        });
        $(self._.el.returnAnyDayCheckbox).click(function(){
            // If the any day checkbox is checked, diable the date picker
            if ($(this).is(':checked')) {
                $(self._.el.returnDateTextBox).attr("disabled", "disabled"); 
            } else {
                $(self._.el.returnDateTextBox).removeAttr("disabled");
            } 
        });
        
        // Form field change event handlers
        $(self._.el.trackableField).change(function(){
            // Send an event to google analytics for the type of form field changed
            _gaq.push(['_trackEvent', 'places', 'changeFormField', $(this).attr('name')]);
        });
        
        // Show and hide the detail forms based on ride type
        $(self._.el.rideTypeDriver).click(function() {
            $(self._.el.driverContainer).show();
            $(self._.el.passengerContainer).hide();
        });
        $(self._.el.rideTypePassenger).click(function() {
            $(self._.el.driverContainer).hide();
            $(self._.el.passengerContainer).show();
        });
        $(self._.el.rideTypeEither).click(function() {
            $(self._.el.driverContainer).show();
            $(self._.el.passengerContainer).show();
        });
        
        // Another ride button on cofirmation section
        $(self._.el.anotherRideButton).click(function(){
            $(place._.el.placeRideConfirmationContainer).hide();
            $(place._.el.placeFormBox).show('blind');
            return false;
        });
        //place starting from auto complete
        autocomplete = new google.maps.places.Autocomplete(document.getElementById("originTextBox"));
   },
   
    geocodeOrigin : function(results, status) {     
        var map = Rootless.Map.Place.getInstance();
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
    	var map = Rootless.Map.Place.getInstance();

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
    
    // Form submit options used for the ajax form
    formAjaxOptions : {
        dataType:  'json',
        beforeSubmit : function() {
            // Clear the form submit pending flag
            isFormSubmitPending = false;
            
            // Send an event to google analytics for the form submission
            _gaq.push(['_trackEvent', 'places', 'createRideSubmitted']);
        },
        success: function(data)
        {
            var place = Rootless.Map.Place.getInstance();
            
            // Unblock the form
            $(place._.el.placeRideContainer).unblock();

            // This handler function will run when the form is complete
            $(place._.el.placeFormBox).hide();
            $(place._.el.placeRideConfirmationContainer).show('blind');
            
            // Send an event to google analytics to show the form was submitted properly
            _gaq.push(['_trackEvent', 'places', 'createRideSuccess']);
        },
        error : function(xhr, status, errMsg)
        {
            var place = Rootless.Map.Place.getInstance();
            
            // See if this is an authentication error
            if (xhr.status == 401)
            {
                // The user is not authorizes, so show the login dialog
                $(place._.el.loginFormDialogContainer).dialog("open");
                
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'places', 'createRideUnauthenticated']);
            }
            else
            {
                // If the resulting object has a message, display it in an alert
                var obj = jQuery.parseJSON(xhr.responseText);
                alert('There was a problem creating the ride. ' + obj.message); 
                
                // Send an event to google analytics for the form submission
                _gaq.push(['_trackEvent', 'places', 'createRideError']);
            }
            
            // Unblock the form
            $(place._.el.placeRideContainer).unblock();
        }
    },
    
    MaybeSubmitForm : function() {
    	var place = Rootless.Map.Place.getInstance();    
        // variable that keeps object available in inner functions
        var self = this;
        // Check to make sure nothing is blocking submitting the form
        if (place.canSubmitForm() && place._.formBlock.isFormSubmitPending) {
            $(place._.el.placeRideContainer).block();
            $(place._.el.rideForm).ajaxSubmit(place.formAjaxOptions);
        }
    }
    
});

Class.addSingleton(Rootless.Map.Place);
