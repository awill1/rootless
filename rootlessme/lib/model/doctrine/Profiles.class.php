<?php

/**
 * Profiles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Profiles extends BaseProfiles
{
    /**
     * Gets the full name of the user
     * @return string The full name
     */
    public function getFullName()
    {
        $fullName = $this->getFirstName();
        if ($this->getFirstName() != null && $this->getLastName() != null)
        {
            $fullName = $fullName . " ";
        }
        $fullName = $fullName . $this->getLastName();
        return $fullName;
    }

    /**
     * Gets the age of the user in years
     * @return int The age in years 
     */
    public function getAge()
    {
        $birth_date = $this->getBirthday();
        //Make sure the birth date is specified
        if(!$birth_date)
        {
            // If not, return null
            return null;
        }
        list($birth_year,$birth_month,$birth_day) = explode("-", $birth_date);
        $year_diff=date("Y")-$birth_year;
        $this_birthday=date("Y").$birth_month.$birth_day;
        $date=date("Ymd");

        if($this_birthday>$date){
            $year_diff--;
        }

        return $year_diff;
    }
    
    /**
     * Tests to see whether a person is the user's friend
     * @return bool True, if the person is the authenticated user's friend.
     * False, if the person is not the authenticated user's friend. 
     */
    public function isMyFriend()
    {
        $myId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
        $profileId = $this->getPersonId();

        // Need sql to match this query
        // select * from friendships f
        // where f.friend1_id = 1 and f.friend2_id = 2
        //    or f.friend2_id = 1 and f.friend1_id = 2;
        $q = Doctrine_Query::create()
                ->select('profile_name')
                ->from('friendships f')
                ->where('f.friend1_id = ? AND f.friend2_id = ?', array($myId, $profileId))
                ->orWhere('f.friend2_id = ? AND f.friend1_id = ?', array($myId, $profileId));

        // Return a boolean indicating whether there was a friendship
        // record found.
        return ($q->count() > 0) ;
    }

    /**
     * Saves the profile
     * @param Doctrine_Connection $conn The database connection
     * @return Profiles The saved profile 
     */
    public function save(Doctrine_Connection $conn = null)
    {
        // Get the connection information
        $conn = $conn ? $conn : $this->getTable()->getConnection();
        // Begin a transaction so it can be rolled back if something goes
        // wrong
        $conn->beginTransaction();
        try
        {
            // Save the profile
            $ret = parent::save($conn);
            // Update the Lucene search index
            $this->updateLuceneIndex();
            // Commit the transaction
            $conn->commit();

            return $ret;
        }
        catch (Exception $e)
        {
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * Deletes the profile
     * @param Doctrine_Connection $conn The database connection
     * @return bool True, if the delete was sucessful. False, otherwise. 
     */
    public function delete(Doctrine_Connection $conn = null)
    {
        // Remove the profile from the Lucene search index
        $index = ProfilesTable::getLuceneIndex();
        foreach ($index->find('pk:'.$this->getId()) as $hit)
        {
            $index->delete($hit->id);
        }

        // Remove the profile from the database
        return parent::delete($conn);
    }

    /**
     * Updates the lucene search index
     */
    public function updateLuceneIndex()
    {
        $index = ProfilesTable::getLuceneIndex();

        // remove existing entries
        foreach ($index->find('profileName:'.$this->getProfileName()) as $hit)
        {
            $index->delete($hit->id);
        }

        // don't index expired and non-activated jobs
//        if ($this->isExpired() || !$this->getIsActivated())
//        {
//            return;
//        }

        $doc = new Zend_Search_Lucene_Document();

        // store profile primary key to identify it in the search results
        $doc->addField(Zend_Search_Lucene_Field::Keyword('profileName', $this->getProfileName()));

        // index profile fields
        $doc->addField(Zend_Search_Lucene_Field::UnStored('firstName', $this->getFirstName(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('lastName', $this->getLastName(), 'utf-8'));

        // add profile to the index
        $index->addDocument($doc);
        $index->commit();
    }

    /**
     * Gets the url of the tiny profile picture
     * @return string The tiny profile picture url  
     */
    public function getPictureUrlTiny()
    {
        // Get the picture url from the doctrine_record
        $pictureUrl = $this->_get('picture_url_tiny');
        
        // If the picture url is null use the default image
        if ($pictureUrl == null)
        {
            $pictureUrl = Profiles::getDefaultPictureUrl('tiny', $this->isFemale());
        }
        
        return $pictureUrl;
    }
    
    /**
     * Gets the url of the small profile picture
     * @return string The small profile picture url  
     */
    public function getPictureUrlSmall()
    {
        // Get the picture url from the doctrine_record
        $pictureUrl = $this->_get('picture_url_small');
        
        // If the picture url is null use the default image
        if ($pictureUrl == null)
        {
            $pictureUrl = Profiles::getDefaultPictureUrl('small', $this->isFemale());
        }
        
        return $pictureUrl;
    }
    
    /**
     * Gets the url of the medium profile picture
     * @return string The medium profile picture url  
     */
    public function getPictureUrlMedium()
    {
        // Get the picture url from the doctrine_record
        $pictureUrl = $this->_get('picture_url_medium');
        
        // If the picture url is null use the default image
        if ($pictureUrl == null)
        {
            $pictureUrl = Profiles::getDefaultPictureUrl('medium', $this->isFemale());
        }
        
        return $pictureUrl;
    }
    
    /**
     * Gets the url of the large profile picture
     * @return string The large profile picture url  
     */
    public function getPictureUrlLarge()
    {
        // Get the picture url from the doctrine_record
        $pictureUrl = $this->_get('picture_url_large');
        
        // If the picture url is null use the default image
        if ($pictureUrl == null)
        {
            $pictureUrl = Profiles::getDefaultPictureUrl('large', $this->isFemale());
        }
        
        return $pictureUrl;
    }
    
    /**
     * Determines whether the profile is female
     * @return boolean True, if the profile is female. False, otherwise.
     */
    public function isFemale()
    {
        $isFemale = false;
        
        // Get the profile gender information
        $gender = $this->getGender();
        if ($gender != null)
        {
            if (strtolower($gender) == 'female')
            {
                $isFemale = true;
            }
        }
        
        return $isFemale;
    }
    
    /**
     * Gets the default picture url for a specific size
     * @param string $size 'tiny', 'small', 'medium', or 'large'
     * @param type $isFemale Indicate whether to use the female default image
     * @return string The default image url 
     */
    protected static function getDefaultPictureUrl($size, $isFemale = false)
    {
        if ($isFemale)
        {
            return sfConfig::get('app_profile_picture_default_female_'.$size);            
        }
        else
        {
            return sfConfig::get('app_profile_picture_default_'.$size);
        }
    }
    
    /**
     * Gets a string containing the profile's city and state
     * @return string The city and state string
     */
    public function getCityStateString()
    {
        // Get the variables
        $city = $this->getCity();
        $state = $this->getState();

        return Locations::createCityStateString($city, $state);
    }
    
    /**
     * Sts the user profile data from facebook
     * @param Json $facebook_user_profile 
     * @param Boolean True if the values should be overwritten, false if only
     * unset values should be set.
     */
    public function setUserDataFromFacebook($facebook_user_profile, $shouldOverwrite = false)
    {
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getFirstName()))
        {
            if (property_exists($facebook_user_profile, 'first_name')) 
            {
                $this->setFirstName($facebook_user_profile->first_name);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getLastName()))
        {
            if (property_exists($facebook_user_profile, 'last_name')) 
            {
                $this->setLastName($facebook_user_profile->last_name);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getFacebookUserName()))
        {
            if (property_exists($facebook_user_profile, 'id')) 
            {
                $this->setFacebookUserName($facebook_user_profile->id);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getGender()))
        {
            if (property_exists($facebook_user_profile, 'gender')) 
            {
                $this->setGender($facebook_user_profile->gender);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getBirthday()))
        {
            if (property_exists($facebook_user_profile, 'birthday')) 
            {
                // Need to reformat the date string in order to save to the
                // database
                $birthdayString = date('Y-m-d',strtotime($facebook_user_profile->birthday));
                
                $this->setBirthday($birthdayString);
            }
        }
        
        //$this->setProfilePicture($facebook_user_profile->picture);
    }
    
    /**
     * Set the location data from facebook graph api
     * @param Json $facebook_location_profile The facebook json for the location
     * @param Boolean $shouldOverwrite True, if the info should be 
     * overwritten. False, otherwise.
     */
    public function setLocationDataFromFacebook($facebook_location_profile, $shouldOverwrite = false)
    {
        // Get location information from facebook
        if (property_exists($facebook_location_profile, 'location')) 
        {
            $location = $facebook_location_profile->location;
            
            if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getCity()))
            {
                if (property_exists($location, 'city'))
                {
                    $this->setCity($location->city);
                }
            }
            if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getState()))
            {
                if (property_exists($location, 'state'))
                {
                    $this->setState($location->state);
                }
            }
//            if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getCounty()))
//            {
//                if (property_exists($location, 'country'))
//                {
//                    $this->setCountry($location->country);
//                }
//            }
        }
    }
    
}