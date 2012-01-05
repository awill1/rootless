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
     * @return object PassengersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Passengers');
    }

    /**
     * Gets all passengers with profiles
     * @return Doctrine_Collection The passengers with profiles 
     */
    public function getWithProfiles()
    {
        $q = $this->createQuery('pa')
          ->leftJoin('pa.People p')
          ->leftJoin('p.Profiles pr');;

        return $q->execute();
    }
    
    /**
     * Returns all passenger record for the authenticated user
     * @return Doctrine_Collection Returns a passengers collection for the user
     */
    public function getMyPassengers()
    {
        // Create the return value
        $passengers = null;

        if (sfContext::getInstance()->getUser()->isAuthenticated())
        {
            // Get the authenticated user's personId
            $myId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
            $passengers = $this->getPassengersForPerson($myId);
        }

        return $passengers;
    }

    /**
     * Returns all passenger records for a person
     * @param int $personId The person to get the passengers for
     * @param bool $includePastItems Whether to include carpools with a 
     * start_date before today in the results
     * @return Doctrine_Collection Returns a Passengers collection
     */
    public function getPassengersForPerson($personId, $includePastItems = false)
    {
        $q = $this->createQuery('pa')
          ->where('pa.person_id = ?', array($personId));
        if (!$includePastItems)
        {
            // Add the current passenger where clause to the query to prevent old 
            // carpools from being returned
            $q = $this->addCurrentRidesFilter($q);
        }

        return $q->execute();
    }
    
    /**
     * Adds a where clause to a query to only return rides occuring today or in
     * the future
     * @param Doctrine_Query $query The query
     * @return Doctrine_Query The query with a current rides where clause 
     */
    public function addCurrentRidesFilter($query)
    {
        // Add a where clause to the query to only return carpools today or in
        // the future
        return $query->andWhere('pa.start_date >= ?', date('Y-m-d'));
    }
}