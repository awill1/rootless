<?php

/**
 * Creates a bulk insert or update query for locations since Doctrine
 * 1.2 does not seem to support bulk inserts. This class is only supported for
 * MySQL.
 *
 * @author awilliams
 */
class LocationsBulkQuery extends BulkQuery
{
        
    // Member variables
    private $items = array();
    
    // Constants
    const INSERT_BASE_QUERY_STRING = 'insert into locations (latitude, longitude, sequence_order, step_id, created_at, updated_at) values ';
    const INSERT_ITEM_QUERY_STRING = '(%f, %f, %d, %d, NOW(), NOW())';
    const INSERT_ITEM_SEPARATOR = ',';
    const UPDATE_BASE_QUERY_STRING = '';
    const UPDATE_ITEM_QUERY_STRING = '';
    const UPDATE_ITEM_SEPARATOR = ',';
    
    /**
     * Adds a doctrine object to a query.
     * @param Array $item The item to add to the query. The item
     * must contain all of these keys: 
     * ('latitude','longitude','sequence_order','step_id')
     */
    public function Add(Array $item)
    {
        // Add the record to the array
        $this->items[] = $item;
    }
    
    /**
     * Gets the bulk insert query string.
     * @return The bulk insert query string
     */
    public function ToInsertQueryString()
    {
        $queryString = self::INSERT_BASE_QUERY_STRING;
 
        $itemsCount = count($this->items);
        for ( $i = 0 ; $i < $itemsCount ; $i++)
        {
            // Get the item from the array
            $item = $this->items[$i];
            
            // Get the items' important information
            $latitude = $item['latitude'];
            $longitude = $item['longitude'];
            $sequenceOrder = $item['sequence_order'];
            $stepId = $item['step_id'];
            
            // Add in the item separator if it is not the first item
            if ($i > 0)
            {
                $queryString .= self::INSERT_ITEM_SEPARATOR;
            }
            
            // Append the values to the query string. Need to verify we are
            // safe against SQL injection attacks here
            $queryString .= sprintf(self::INSERT_ITEM_QUERY_STRING, $latitude, $longitude, $sequenceOrder, $stepId);
        }
        
        return $queryString;
    }
    
    /**
     * Gets the bulk update query string.
     * @return The bulk update query string
     */
    public function ToUpdateQueryString()
    {
        throw new Exception('Not implemented.');
    }
}

?>
