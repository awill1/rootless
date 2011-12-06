/*
 * This is the javascript for the Google Map Helper functions
 */

/**
 * formatGoogleJSON is used to change the strange keys used for 
 * latitude and longitude into easier to use "lat" and "lon" keys.
 * The quotes must be included or else we could replace unexpected 
 * pieces of the string such as street name or encoded polyline
 */
function formatGoogleJSON(strangeLat, strangeLon, jsonString) {
    // Build the regular expressions, and return the replacement
    var strangeLatRegExp = new RegExp("\""+strangeLat+"\"","g");
    var strangeLonRegExp = new RegExp("\""+strangeLon+"\"","g");
    return jsonString.replace(strangeLatRegExp,"\"lat\"")
                     .replace(strangeLonRegExp, "\"lon\"");
}