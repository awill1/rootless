<?php

/**
 * PassengersTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PassengersTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PassengersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Passengers');
    }

    public function getWithProfiles()
    {
        $q = $this->createQuery('c')
          ->leftJoin('c.People p')
          ->leftJoin('p.Profiles pr');;

        return $q->execute();
    }

    public function getConfirmedPassengersForPerson($personId)
    {
        // Need the sql query to look like this
        // SELECT * from passengers pa
        // INNER JOIN people p
        // ON pa.person_id = p.person_id
        // INNER JOIN profiles ppr
        // ON ppr.person_id = p.person_id
        // INNER JOIN seats s
        // ON s.passenger_id = pa.passenger_id
        // INNER JOIN carpools c
        // ON s.carpool_id = c.carpool_id
        // INNER JOIN people d
        // ON c.driver_id = d.person_id
        // INNER JOIN profiles dpr
        // ON dpr.person_id = d.person_id
        // WHERE ( s.seat_status_id = 2 )
        // AND c.carpool_id IN
        //     (SELECT c.carpool_id
        //      FROM carpools c
        //      LEFT JOIN seats s
        //      ON s.carpool_id = c.carpool_id
        //      LEFT JOIN passengers p
        //      ON s.passenger_id = p.passenger_id
        //      WHERE (s.seat_status_id = 2 AND p.person_id = 1)
        //         OR
        //        ( c.driver_id = 1));
        $q = $this->createQuery('pa')
                ->innerJoin('pa.People p')
                ->innerJoin('p.Profiles ppr')
                ->innerJoin('pa.Seats s')
                ->innerJoin('s.Carpools c')
                ->innerJoin('c.People d')
                ->innerJoin('d.Profiles dpr')
                ->where('s.seat_status_id = ?', 2)
                ->andWhere('c.carpool_id IN (
                    SELECT c2.carpool_id
                    FROM carpools c2
                    LEFT JOIN c2.Seats s2
                    LEFT JOIN s2.Passengers p2
                    WHERE (s2.seat_status_id = ? AND p2.person_id = ?)
                    OR ( c2.driver_id = ?))', array(2, $personId, $personId));

        return $q->execute();
    }
}