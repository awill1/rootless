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
    */
   init : function(params) {
       this._ = $.extend(true, {
           
           
       }, params);
   }
   
   
    
});

Class.addSingleton(Rootless.Map);

/*
var RootlessMap = function(spec) {
    var self = this;
    this.mapInfo = spec;
    this.map = null;
    
    this._ = {
        el : {
            $loader : $('#loader')
        }
    }
    

    this.mapInfo.PRIMARY_ROUTE_COLOR = "#119F49";
    this.mapInfo.PRIMARY_ROUTE_OPACITY = .5;
    this.mapInfo.PRIMARY_ROUTE_WEIGHT = 5;
    this.mapInfo.SECONDARY_ROUTE_COLOR = "#FF0000";
    this.mapInfo.SECONDARY_ROUTE_OPACITY = .5;
    this.mapInfo.SECONDARY_ROUTE_WEIGHT = 5;
    this.mapInfo.TERTIARY_ROUTE_COLOR = "#FF0000";
    this.mapInfo.TERTIARY_ROUTE_OPACITY = .2;
    this.mapInfo.TERTIARY_ROUTE_WEIGHT = 5;

    this.mapInfo.MAP_DEFAULT_LATITUDE = 37.0625;
    this.mapInfo.MAP_DEFAULT_LONGITUDE = -95.677068;
    this.mapInfo.MAP_DEFAULT_ZOOM = 3;
    
    this.mapInfo.polylines = {};
   
    
    /**
     * Variables used to block form submitting before map spi results are returned
     
    this.mapInfo.isOriginDecodePending = false;
    this.mapInfo.isDestinationDecodePending = false;
    this.mapInfo.isDirectionsPending = false;
    this.mapInfo.isFormSubmitPending = false;
    
    this._initialize = function() {
        // Google map loading
        
        var latlng = new google.maps.LatLng(self.mapInfo.MAP_DEFAULT_LATITUDE, self.mapInfo.MAP_DEFAULT_LONGITUDE);
        var myOptions = {
            zoom: self.mapInfo.MAP_DEFAULT_ZOOM,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var mapObj = new google.maps.Map(document.getElementById(self.mapInfo.mapId),
            myOptions);
      
        self.map = mapObj;
    };
    
    
  
    
    this._initialize();
    
    return self;
}
    */