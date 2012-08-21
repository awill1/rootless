/*
 * Initializes a Google Map into a div
 * @constructor rootlessmap
 * @param mapId <String> The id of the div which will contain the map
 * This script requires the Google Map and JQuery scripts to already be loaded
 * in the browser.
 */


function rootlessmap(spec) {
    // variable to always be able to reference the parent "object"
    var self = this;
    
    this.mapInfo = spec;
    this.map = null;
    
    this._ = {
        el : {
            $loader : $('#loader')
        }
    }
    
    /**
     * Constants used for google maps
     */
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
     */
    this.mapInfo.isOriginDecodePending = false;
    this.mapInfo.isDestinationDecodePending = false;
    this.mapInfo.isDirectionsPending = false;
    this.mapInfo.isFormSubmitPending = false;
    
    
    /**
     *  Initializes the Google Maps API
     *  @returns google.maps.Map The created map
     */
    this._initialize = function() {
        // Google map loading
        
        this._.el.$loader.hide();
        
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
    
    
   /* this._initializeMarker = function() {
        // Setup the origin and destination marker, the maps are null
        // because the markers are hidden
        var latlng = new google.maps.LatLng(MAP_DEFAULT_LATITUDE, MAP_DEFAULT_LONGITUDE);
        return new google.maps.Marker({
               position: latlng,
               map: null,
               title: title
        });
    };
    
    this._initializePath = function() {   
    // Return the a primary polyline
    return createPrimaryPolyline(new Array());
    };

     */
  
    
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

rootlessmap.formatGoogleJSON = function(strangeLat, strangeLon, jsonString) {
    // Build the regular expressions, and return the replacement
    var strangeLatRegExp = new RegExp("\""+strangeLat+"\"","g");
    var strangeLonRegExp = new RegExp("\""+strangeLon+"\"","g");
    return jsonString.replace(strangeLatRegExp,"\"lat\"")
                     .replace(strangeLonRegExp, "\"lon\"");
}

