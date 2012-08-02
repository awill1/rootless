/*
 * Initializes a Google Map into a div
 * @constructor RootlessMap
 * @param mapId <String> The id of the div which will contain the map
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */


function RootlessMap(mapId) {
    // variable to always be able to reference the parent "object"
    var self = this;
    this.map = null;
    
    // <String> The id of the div which will contain the map
    this.mapId = mapId;
    
    
    /**
     * Constants used for google maps
     */
    this.PRIMARY_ROUTE_COLOR = "#119F49";
    this.PRIMARY_ROUTE_OPACITY = .5;
    this.PRIMARY_ROUTE_WEIGHT = 5;
    this.SECONDARY_ROUTE_COLOR = "#FF0000";
    this.SECONDARY_ROUTE_OPACITY = .5;
    this.SECONDARY_ROUTE_WEIGHT = 5;
    this.TERTIARY_ROUTE_COLOR = "#FF0000";
    this.TERTIARY_ROUTE_OPACITY = .2;
    this.TERTIARY_ROUTE_WEIGHT = 5;

    this.MAP_DEFAULT_LATITUDE = 37.0625;
    this.MAP_DEFAULT_LONGITUDE = -95.677068;
    this.MAP_DEFAULT_ZOOM = 3;
   
    
    /**
     * Variables used to block form submitting before map spi results are returned
     */
    this.isOriginDecodePending = false;
    this.isDestinationDecodePending = false;
    this.isDirectionsPending = false;
    this.isFormSubmitPending = false;
    
    
    /**
     *  Initializes the Google Maps API
     *  @returns google.maps.Map The created map
     */
    this._initialize = function() {
        // Google map loading
        
        var latlng = new google.maps.LatLng(self.MAP_DEFAULT_LATITUDE, self.MAP_DEFAULT_LONGITUDE);
        var myOptions = {
            zoom: self.MAP_DEFAULT_ZOOM,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var mapObj = new google.maps.Map(document.getElementById(self.mapId),
            myOptions);
      
        self.map = mapObj;
    };
    
    
  
  
    
    this._initialize();
}

/**
 * formatGoogleJSON - Public function
 * formatGoogleJSON is used to change the strange keys used for 
 * latitude and longitude into easier to use "lat" and "lon" keys.
 * The quotes must be included or else we could replace unexpected 
 * pieces of the string such as street name or encoded polyline
 * 
 * This can be accessed within templates
 */

RootlessMap.prototype.formatGoogleJSON = function(strangeLat, strangeLon, jsonString) {
    // Build the regular expressions, and return the replacement
    var strangeLatRegExp = new RegExp("\""+strangeLat+"\"","g");
    var strangeLonRegExp = new RegExp("\""+strangeLon+"\"","g");
    return jsonString.replace(strangeLatRegExp,"\"lat\"")
                     .replace(strangeLonRegExp, "\"lon\"");
}

