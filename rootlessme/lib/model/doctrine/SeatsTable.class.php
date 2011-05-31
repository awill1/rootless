<?php

/**
 * SeatsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SeatsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SeatsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Seats');
    }

    public function getTravelSummaryForPerson($person_id)
    {
        $connection = Doctrine_Manager::connection();
        // Get the rides received count first
        $query = 'SELECT COUNT(*) AS rides_received
                    FROM seats s
                    INNER JOIN seat_statuses ss
                    ON ss.seat_status_id = s.seat_status_id
                    WHERE s.pickup_date < now()
                    AND ss.slug = "accepted"
                    AND s.passenger_id = '.$person_id;
        $statement = $connection->execute($query);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_OBJ);
        $ridesReceived = $resultset->rides_received;
        // Get the rides given count second
        $query = 'SELECT COUNT(*) AS rides_given
                    FROM seats s
                    INNER JOIN seat_statuses ss
                      ON ss.seat_status_id = s.seat_status_id
                    INNER JOIN carpools c
                      ON c.carpool_id = s.carpool_id
                    WHERE s.pickup_date < now()
                    AND ss.slug = "accepted"
                    AND c.driver_id = '.$person_id;
        $statement = $connection->execute($query);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_OBJ);
        $ridesGiven = $resultset->rides_given;

        return array(
            'ridesReceived' => $ridesReceived,
            'ridesGiven' => $ridesGiven
        );
    }
}