<?php

/**
 * PeopleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PeopleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PeopleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('People');
    }
    
    /**
     * Gets a person with their profile
     * @param Integer $personId The id of the person
     * @return People The person if found. Null, otherwise
     */
    public function getPersonWithProfile($personId)
    {
        $person = NULL;
        $q = $this->createQuery('p')
                ->innerJoin('p.Profiles pr')
                ->where('p.person_id = ?', array($personId));
        $results = $q->execute();
        if($results->count() == 1)
        {
            $person = $results->getFirst();
        }
        return $person;
    }
}