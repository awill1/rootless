<?php
/**
 * Ride helper functions used throughout the website
 *
 * @author awilliams
 */
class RideHelpers 
{
    /**
     * 
     * @param Doctrine_Collection $passengers The passengers
     * @param Doctrine_Collection $drivers The drivers
     * @param DateTime $start_date The start date of the valid date range
     * @param DateTime $end_date The end date of the valid date range
     * @return array The rides as an array, with the key as a date, and the 
     * value an array of rides.
     */
    public static function combinePassengersAndDrivers($passengers, $drivers, $start_date, $end_date)
    {
        // Create the rides array with all days in the rdate range as keys
        $rides = array();
        
        for ($dateIndex = clone $start_date ; $dateIndex <= $end_date ; $dateIndex->modify('+1 day'))
        {
            $rides[$dateIndex->format('Y-m-d')] = array();
        }
        
        // Go through the passengers and get the anyday rides
        foreach ($passengers as $i => $passenger) 
        {
            $passengerStartDate = $passenger->getStartDate();
            if (is_null($passengerStartDate))
            {
                RideHelpers::addObjectToAllArrays($passenger, $rides);
            }
            elseif (array_key_exists($passengerStartDate, $rides))
            {
                $rides[$passengerStartDate][] = $passenger;
            }
        }
        // Go through the drivers and get the anyday rides
        foreach ($drivers as $i => $driver) 
        {
            $driverStartDate = $driver->getStartDate();
            if (is_null($driverStartDate))
            {
                RideHelpers::addObjectToAllArrays($driver, $rides);
            }
            elseif (array_key_exists($driverStartDate, $rides))
            {
                $rides[$driverStartDate][] = $driver;
            }
        }
        
        return $rides;
    }
    
    /**
     * Adds the object to all arrays in the array
     * @param type $object The object to add
     * @param array $array The array with other child arrays
     */
    private static function addObjectToAllArrays($object, &$array)
    {
        foreach ($array as $key => $value) 
        {
            array_push($array[$key], $object);
        }
    }


    
	/**
	 * Combine objects into an array (check _ridesList.php for sample usage)
	 * @param Integer $key the iteration number in for loop
	 * @param Object $object the object that needs place in array
	 * @param Reference of Array &$array the array that is being edited
	 * @return nothing because this is used in for loops and is editing a reference variable you set
	 */
	public static function combineObjectsIntoArray($key, $object, &$array) 
	{
            $setKey = ($key == "") ? 0 : $key;
            if (!isset($array[$setKey])) {
                $array[$setKey] = array($object);
            } else {
                $length = count($array[$setKey]);
                $array[$setKey][$length] = $object;
            }
	}
	
	public static function addOpenEndedRidesToArray($openRides, &$array)
	{
		foreach ($array as $key => $value) {
			if ($key != 0) {
			    $length = count($array[$key]);
				$array[$key][$length]  = $openRides;
			}
		}
	}

}

?>
