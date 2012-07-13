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
     * Tests whether a string is null or empty (present and neither empty 
     * nor only white space)
     * @param String $question The string to test
     * @return Boolean True, if the string is null or empty. False, otherwise. 
     */
    public static function IsNullOrEmptyString($question)
    {
        return (!isset($question) || trim($question)==='');
    }
    
    public static function urlParser($url) {
        if (preg_match('/^http:\/\//', $url)) {
            return $url;
        } else {
            return "http://" . $url;
        }
        
    }

}

?>
