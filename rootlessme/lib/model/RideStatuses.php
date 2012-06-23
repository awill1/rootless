<?php

/**
 * RideStatuses
 * 
 */
class RideStatuses
{
    const RIDE_OPEN = 'open' ;
    const RIDE_CLOSED = 'closed' ;
    const RIDE_DELETED = 'deleted' ;
    
    
    /**
     * The supported ride status types. This is a shortcut instead of
     * querying the database.
     * @var string The seat status type
     */
    public static $statuses = array('open' => 1,
                                     'closed' => 2,
                                     'deleted' => 3);
}
?>