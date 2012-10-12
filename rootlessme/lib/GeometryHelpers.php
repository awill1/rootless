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
}



?>
