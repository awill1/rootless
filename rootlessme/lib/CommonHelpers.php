<?php
/**
 * Common helper functions used throughout the website
 *
 * @author awilliams
 */
class CommonHelpers {

    /**
     * Creates a 32 byte UUID with the format XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
     * Based on http://stackoverflow.com/questions/4049455/how-to-create-a-uuid-in-php-without-a-external-library
     * @return String The UUID
     */
    public static function CreateUuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    
    /**
     * Creates a 32 byte UUID with the format XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
     * @return String The UUID
     */
    public static function CreateSimpleUuid() {
        return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    
    /**
     * Create temporary password. Used for new users who did not choose a password
     * @return String The generated password
     */
    public static function CreateTemporaryPassword() {
        return md5(rand() + time());
    }

    /**
     * Tests whether a string is null or empty (present and neither empty 
     * nor only white space)
     * @param String $question The string to test
     * @return Boolean True, if the string is null or empty. False, otherwise. 
     */
    public static function IsNullOrEmptyString($question)
    {
        return (!isset($question) || trim($question)==='');
    }
    
    /**
     * Makes sure there is a http:// at the beginning of the url
     * @param String $url The url
     * @return String The full url including http://
     */
    public static function urlParser($url) {
        if (preg_match('/^http:\/\//', $url)) {
            return $url;
        } else {
            return "http://" . $url;
        }
        
    }
    
    /**
     * Gets the first name from a full name string. This is just the first 
     * word before the first space. This may not yeild the desired results
     * for multiple first names, like Mary Ann.
     * @param String $fullName The full name
     * @return String The first name
     */
    public static function getFirstName($fullName)
    {
        $fullName = trim($fullName);
        $firstName = NULL;
        $spacePosition = strpos($fullName, ' ');
        if ($spacePosition === false) {
            $firstName = $fullName;
        } else {
            $firstName = substr($fullName, 0, $spacePosition);
        }
        return $firstName;
    }
    
    
    /**
     * Gets the last name from a full name string. This is just the  
     * words after the first space. This may not yeild the desired results
     * for multiple first names, like Mary Ann.
     * @param String $fullName The full name
     * @return String The last name
     */
    public static function getLastName($fullName)
    {
        $fullName = trim($fullName);
        $lastName = NULL;
        $spacePosition = strpos($fullName, ' ');
        if ($spacePosition === false) {
            // No last name was found
            $lastName = NULL;
        } else {
            // Make sure the space is not at the end
            if (($spacePosition + 1) < strlen($fullName))
            {
                $lastName = substr($fullName, $spacePosition + 1);
            }
        }
        return $lastName;
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
		if (!isset($array[$key]) && $key != "") {
    	    $array[$key] = array($object);
		} elseif($key == "") {
			foreach ($array as $key => $value) {
				$length = count($array[$key]);
				$array[$key][$length]  = $object;
			}
		} else {
			$length = count($array[$key]);
		    $array[$key][$length] = $object;
		}
	}

}

?>
