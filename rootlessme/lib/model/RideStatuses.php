<?php

/**
 * RideStatuses
 * 
 */
class RideStatuses
{
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