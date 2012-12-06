<?php
/**
 * Geometry helper functions used throughout the website
 *
 * @author awilliams
 */
class GeometryHelpers 
{

    /**
     * Gets the distance betwee points
     * @link http://www.marketingtechblog.com/calculate-distance/ The original 
     * source of this function
     * 
     * @param Double $latitude1 The latitude of point 1
     * @param Double $longitude1 The longitude of point 1
     * @param Double $latitude2 The latitude of point 2
     * @param Double $longitude2 The longitude of point 2
     * @param String $unit 'Mi' for miles, or 'Km' for kilometers. Default is 'Mi'
     * @return Double The distance between the points.
     */
    public static function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') 
    { 
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); $distance = rad2deg($distance); $distance = $distance * 60 * 1.1515; 
        switch($unit) 
        { 
            case 'Mi': 
                break; 
            case 'Km' : 
                $distance = $distance * 1.609344; 
        } 
        return $distance;    
    }
    
    /**
     * Decodes a polyline that was encoded using the Google Maps method.
     *
     * The encoding algorithm is detailed here:
     * http://code.google.com/apis/maps/documentation/polylinealgorithm.html
     *
     * This function is based off of Mark McClure's JavaScript polyline decoder
     * (http://facstaff.unca.edu/mcmcclur/GoogleMaps/EncodePolyline/decode.js)
     * which was in turn based off Google's own implementation.
     *
     * This function assumes a validly encoded polyline.  The behaviour of this
     * function is not specified when an invalid expression is supplied.
     *
     * @param String $encoded the encoded polyline.
     * @return Array an Nx2 array with the first element of each entry containing
     *  the latitude and the second containing the longitude of the
     *  corresponding point.
     * 
     * @link http://unitstep.net/blog/2008/08/02/decoding-google-maps-encoded-polylines-using-php/
     * The original source of this script.
     */
    public static function decodePolylineToArray($encoded)
    {
        $length = strlen($encoded);
        $index = 0;
        $points = array();
        $lat = 0;
        $lng = 0;

        while ($index < $length)
        {
            // Temporary variable to hold each ASCII byte.
            $b = 0;

            // The encoded polyline consists of a latitude value followed by a
            // longitude value.  They should always come in pairs.  Read the
            // latitude value first.
            $shift = 0;
            $result = 0;
            do
            {
                // The `ord(substr($encoded, $index++))` statement returns the ASCII
                //  code for the character at $index.  Subtract 63 to get the original
                // value. (63 was added to ensure proper ASCII characters are displayed
                // in the encoded polyline string, which is `human` readable)
                $b = ord(substr($encoded, $index++)) - 63;

                // AND the bits of the byte with 0x1f to get the original 5-bit `chunk.
                // Then left shift the bits by the required amount, which increases
                // by 5 bits each time.
                // OR the value into $results, which sums up the individual 5-bit chunks
                // into the original value.  Since the 5-bit chunks were reversed in
                // order during encoding, reading them in this way ensures proper
                // summation.
                $result |= ($b & 0x1f) << $shift;
                $shift += 5;
            }
            // Continue while the read byte is >= 0x20 since the last `chunk`
            // was not OR'd with 0x20 during the conversion process. (Signals the end)
            while ($b >= 0x20);

            // Check if negative, and convert. (All negative values have the last bit
            // set)
            $dlat = (($result & 1) ? ~($result >> 1) : ($result >> 1));

            // Compute actual latitude since value is offset from previous value.
            $lat += $dlat;

            // The next values will correspond to the longitude for this point.
            $shift = 0;
            $result = 0;
            do
            {
                $b = ord(substr($encoded, $index++)) - 63;
                $result |= ($b & 0x1f) << $shift;
                $shift += 5;
            }
            while ($b >= 0x20);

            $dlng = (($result & 1) ? ~($result >> 1) : ($result >> 1));
            $lng += $dlng;

            // The actual latitude and longitude values were multiplied by
            // 1e5 before encoding so that they could be converted to a 32-bit
            // integer representation. (With a decimal accuracy of 5 places)
            // Convert back to original values.
            $points[] = array('lat' => $lat * 1e-5, 'lon' => $lng * 1e-5);
        }

        return $points;
    }
}



?>
