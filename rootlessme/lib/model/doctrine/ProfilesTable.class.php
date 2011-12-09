<?php

/**
 * ProfilesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfilesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProfilesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Profiles');
    }

    /**
     * Gets a person's friends' profiles
     * @param type $person_id The person
     * @return Doctrine_Collection The friends' profiles 
     */
    public function getFriendsProfiles($person_id)
    {
        // Need this function to match this query
        // select * from profiles
        // where person_id IN (
        // select f.friend1_id as friend_id
        // from friendships f
        // where f.friend2_id = 1
        // union all
        // select f2.friend2_id as friend_id
        // from friendships f2
        // where f2.friend1_id = 1);

        $q = $this->createQuery('p')
                ->where('p.person_id IN (select friend1_id as friend_id from friendships where friend2_id = ? union all select friend2_id as friend_id from friendships where friend1_id = ?)', array($person_id, $person_id));

        return $q->execute();
    }

    /**
     * Gets the profils of mutual friends between two people
     * @param type $person1_id The first person
     * @param type $person2_id The second person
     * @return Doctrine_Collection The friends' profiles 
     */
    public function getMutualFriendsProfiles($person1_id, $person2_id)
    {
        // Need this function to match this query
        // select * from profiles p
        // where p.person_id in (
        //     select f.friend1_id as friend_id
        //     from friendships f
        //     where f.friend2_id = 2
        //     union all
        //     select f2.friend2_id as friend_id
        //     from friendships f2
        //     where f2.friend1_id = 2)
        // AND p.person_id in (
        //     select f.friend1_id as friend_id
        //     from friendships f
        //     where f.friend2_id = 3
        //     union all
        //     select f2.friend2_id as friend_id
        //     from friendships f2
        //     where f2.friend1_id = 3
        // );

        $q = $this->createQuery('p')
                ->where('p.person_id IN (select friend1_id as friend_id from friendships where friend2_id = ? union all select friend2_id as friend_id from friendships where friend1_id = ?)', array($person1_id, $person1_id))
                ->andWhere('p.person_id IN (select friend1_id as friend_id from friendships where friend2_id = ? union all select friend2_id as friend_id from friendships where friend1_id = ?)', array($person2_id, $person2_id));

        return $q->execute();
    }

    /**
     * Gets a Lucene index
     * @return type The Lucene index
     */
    static public function getLuceneIndex()
    {
        ProjectConfiguration::registerZend();

        if (file_exists($index = self::getLuceneIndexFile()))
        {
            return Zend_Search_Lucene::open($index);
        }

        return Zend_Search_Lucene::create($index);
    }

    static public function getLuceneIndexFile()
    {
        // Get the Lucene search index file
        return sfConfig::get('sf_data_dir').'/profile.'.sfConfig::get('sf_environment').'.index';
    }
    
    public function getForLuceneQuery($query)
    {
        $hits = self::getLuceneIndex()->find($query);

        $pks = array();
        foreach ($hits as $hit)
        {
            $pks[] = $hit->profileName;
        }

        if (empty($pks))
        {
            return array();
        }

        $q = $this->createQuery('p')
            ->whereIn('p.profile_name', $pks);
//            ->limit(20)

//        $q = $this->addActiveJobsQuery($q);

        return $q->execute();
    }
    
    /**
     * Gets the profiles of all people who are confirmed to be traveling with
     * a person
     * @param type $personId The person
     * @return Doctrine_Collection The profiles of the traveling companions
     */
    public function getTravelingWithProfiles($personId)
    {
        // Get a list of people ids for confirmed passengers in carpools
        // the user is driving
        $pq = Doctrine_Query::create() 
                ->select('p.person_id')
                ->from('People p')
                ->innerJoin('p.Passengers pa')
                ->innerJoin('pa.Seats s')
                ->innerJoin('s.Carpools c')
                ->where('s.seat_status_id = ?', 2)
                ->andWhere('c.driver_id = ?', $personId);
        $passengers = $pq->execute();
        
        // Get a list of people ids for confirmed drivers in carpools
        // the user is riding in
        $dq = Doctrine_Query::create() 
                ->select('p.person_id')
                ->from('People p')
                ->innerJoin('p.Carpools c')
                ->innerJoin('c.Seats s')
                ->innerJoin('s.Passengers pa')
                ->where('s.seat_status_id = ?', 2)
                ->andWhere('pa.person_id = ?', $personId);
        $drivers = $dq->execute();
        
        // Get a list of people ids for confirmed passenger in carpools
        // the user is riding in
        // Fill in later
        
        // Combine the people id lists for all types of travel companions
        $personIds = array();
        foreach ($passengers as $passenger)
        {
            $personIds[] = $passenger->getPersonId();
        }
        foreach ($drivers as $driver)
        {
            $personIds[] = $driver->getPersonId();
        }
        
        // Check to see if the traveler list is empty
        if (empty($personIds))
        {
            return new Doctrine_Collection('Profiles');
        }
        
        // Get the profiles for the person ids
        $q = $this->createQuery('p')
            ->whereIn('p.person_id', $personIds);
        return $q->execute();
    }
}