<?php

/**
 * Locations
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Locations extends BaseLocations
{
    /**
     * Gets a string containing the location's city and state
     * @return string The city and state string
     */
    public function getCityStateString()
    {
        // Return variables
        $returnString = "";
        $city = $this->getCity();
        $state = $this->getState();

        // Depending on what information is known, build the return string
        if ($city != null )
        {
            $returnString = $city;
        }
        if ($city != null && $state != null )
        {
            $returnString = $returnString.", ";
        }
        if ($state != null)
        {
            $returnString = $returnString.$state;
        }

        return $returnString;

    }

    /**
     * Creates and saves a location based on a json string from the 
     * Google geocode api.
     * @param String $googleGeocode The json string from the Google geocode api
     * @return void No return 
     */
    public function createFromGoogleGeocode($googleGeocode = null)
    {
        sfContext::getInstance()->getLogger()->debug($googleGeocode);

        // Make sure the geocode is not null
        if ($googleGeocode == null)
        {
            sfContext::getInstance()->getLogger()->error("googleGeocode is null.");
            return;
        }

        // The geocode should be in JSON format, so decode them
        $jLocation = json_decode($googleGeocode, true);
        if (json_last_error() != JSON_ERROR_NONE)
        {
            sfContext::getInstance()->getLogger()->error("JSON last error: ".json_last_error());
            return;
        }

        // Update the location based on the geocoded information
        $this->setName($jLocation['formatted_address']);
        $streetNumber = "";
        $street1 = "";
        foreach ($jLocation['address_components'] as $addressComponent)
        {
            
            // Street Number
            if (in_array("street_number",$addressComponent["types"]))
            {
                $streetNumber = $addressComponent["long_name"];
            }
            // Street1
            if (in_array("route",$addressComponent["types"]))
            {
                $street1 = $addressComponent["long_name"];
            }
            // Postal Code
            if (in_array("postal_code",$addressComponent["types"]))
            {
                $this->setPostalCode($addressComponent["long_name"]);
            }
            // City
            if (in_array("locality",$addressComponent["types"]))
            {
                $this->setCity($addressComponent["long_name"]);
            }
            // State
            if (in_array("administrative_area_level_1",$addressComponent["types"]))
            {
                $this->setState($addressComponent["short_name"]);
            }
            // Country
            if (in_array("country",$addressComponent["types"]))
            {
                $this->setCountry($addressComponent["short_name"]);
            }
        }

        // Update the street if either component was found
        if ( $streetNumber!="" || $street1 != "")
        {
            $this->setStreet1(trim($streetNumber." ".$street1));
        }

        
        // Save this location with the updates
        $this->save();

        return;

    }
    
    /**
     * Gets a bounding box for a point and a distance
     * @param float $lat_degrees
     * @param float $lon_degrees
     * @param float $distance_in_miles
     * @return Array The resulting latitude and longitudes for the bounding box.
     * The array contains the following keys, 'minLatitude', 'maxLatitude',
     * 'minLongitude', 'maxLongitude'
     */
    public static function getBoundingBox($lat_degrees,$lon_degrees,$distance_in_miles)
    {
        // This function was found at:
        // http://stackoverflow.com/questions/2628039/php-library-calculate-a-bounding-box-for-a-given-lat-lng-location
        
        $radius = 3963.1; // of earth in miles

        // bearings 
        $due_north = 0;
        $due_south = 180;
        $due_east = 90;
        $due_west = 270;

        // convert latitude and longitude into radians 
        $lat_r = deg2rad($lat_degrees);
        $lon_r = deg2rad($lon_degrees);

        // find the northmost, southmost, eastmost and westmost corners $distance_in_miles away
        // original formula from
        // http://www.movable-type.co.uk/scripts/latlong.html

        $northmost  = asin(sin($lat_r) * cos($distance_in_miles/$radius) + cos($lat_r) * sin ($distance_in_miles/$radius) * cos($due_north));
        $southmost  = asin(sin($lat_r) * cos($distance_in_miles/$radius) + cos($lat_r) * sin ($distance_in_miles/$radius) * cos($due_south));

        $eastmost = $lon_r + atan2(sin($due_east)*sin($distance_in_miles/$radius)*cos($lat_r),cos($distance_in_miles/$radius)-sin($lat_r)*sin($lat_r));
        $westmost = $lon_r + atan2(sin($due_west)*sin($distance_in_miles/$radius)*cos($lat_r),cos($distance_in_miles/$radius)-sin($lat_r)*sin($lat_r));


        $northmost = rad2deg($northmost);
        $southmost = rad2deg($southmost);
        $eastmost = rad2deg($eastmost);
        $westmost = rad2deg($westmost);

        // sort the lat and long so that we can use them for a between query        
        if ($northmost > $southmost) { 
            $lat1 = $southmost;
            $lat2 = $northmost;

        } else {
            $lat1 = $northmost;
            $lat2 = $southmost;
        }


        if ($eastmost > $westmost) { 
            $lon1 = $westmost;
            $lon2 = $eastmost;

        } else {
            $lon1 = $eastmost;
            $lon2 = $westmost;
        }

        return array('minLatitude'=>$lat1,
                     'maxLatitude'=>$lat2,
                     'minLongitude'=>$lon1,
                     'maxLongitude'=>$lon2);
    }

    
    /**
     * Returns a string that represents the location. Overrides the default
     * __toString method.
     * @return string The location represented as a string
     */
    public function __toString()
    {
        return $this->getCityStateString();
    }
}