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
           // Variables used to block form submitting before map api results are returned
           formBlock : {
               isOriginDecodePending : false,
               isDestinationDecodePending : false,
               isDirectionsPending : false,
               isFormSubmitPending : false
           },
           
           //all html elements referred in the code should go here (including jquery)
           el : {
               
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
    }
   
   
    
});

Class.addSingleton(Rootless.Map);