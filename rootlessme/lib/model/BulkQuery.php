<?php

/**
 * Abstract class for creating a bulk insert or update query since Doctrine
 * 1.2 does not seem to support bulk inserts. This class is only supported for
 * MySQL.
 *
 * @author awilliams
 */
abstract class BulkQuery
{
    /**
     * Adds a doctrine object to a query.
     */
    abstract public function Add(Array $item);
    
    /**
     * Gets the bulk insert query string.
     */
    abstract public function ToInsertQueryString();
    
    /**
     * Gets the bulk update query string.
     */
    abstract public function ToUpdateQueryString();
}

?>
