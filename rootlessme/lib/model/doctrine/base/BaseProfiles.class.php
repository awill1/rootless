<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Profiles', 'doctrine');

/**
 * BaseProfiles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $profile_name
 * @property integer $person_id
 * @property string $first_name
 * @property string $last_name
 * @property string $picture_url
 * @property string $picture_url_large
 * @property string $picture_url_medium
 * @property string $picture_url_small
 * @property string $picture_url_tiny
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 * @property date $birthday
 * @property string $gender
 * @property string $about_me
 * @property string $top5
 * @property string $wants_to_travel_to
 * @property string $music
 * @property string $movies
 * @property string $books
 * @property string $interests
 * @property string $favorite_websites
 * @property string $website_url
 * @property string $facebook_user_name
 * @property string $twitter_user_name
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * 
 * @method string    getProfileName()        Returns the current record's "profile_name" value
 * @method integer   getPersonId()           Returns the current record's "person_id" value
 * @method string    getFirstName()          Returns the current record's "first_name" value
 * @method string    getLastName()           Returns the current record's "last_name" value
 * @method string    getPictureUrl()         Returns the current record's "picture_url" value
 * @method string    getPictureUrlLarge()    Returns the current record's "picture_url_large" value
 * @method string    getPictureUrlMedium()   Returns the current record's "picture_url_medium" value
 * @method string    getPictureUrlSmall()    Returns the current record's "picture_url_small" value
 * @method string    getPictureUrlTiny()     Returns the current record's "picture_url_tiny" value
 * @method string    getAddress1()           Returns the current record's "address1" value
 * @method string    getAddress2()           Returns the current record's "address2" value
 * @method string    getCity()               Returns the current record's "city" value
 * @method string    getState()              Returns the current record's "state" value
 * @method string    getPostalCode()         Returns the current record's "postal_code" value
 * @method string    getCountry()            Returns the current record's "country" value
 * @method date      getBirthday()           Returns the current record's "birthday" value
 * @method string    getGender()             Returns the current record's "gender" value
 * @method string    getAboutMe()            Returns the current record's "about_me" value
 * @method string    getTop5()               Returns the current record's "top5" value
 * @method string    getWantsToTravelTo()    Returns the current record's "wants_to_travel_to" value
 * @method string    getMusic()              Returns the current record's "music" value
 * @method string    getMovies()             Returns the current record's "movies" value
 * @method string    getBooks()              Returns the current record's "books" value
 * @method string    getInterests()          Returns the current record's "interests" value
 * @method string    getFavoriteWebsites()   Returns the current record's "favorite_websites" value
 * @method string    getWebsiteUrl()         Returns the current record's "website_url" value
 * @method string    getFacebookUserName()   Returns the current record's "facebook_user_name" value
 * @method string    getTwitterUserName()    Returns the current record's "twitter_user_name" value
 * @method timestamp getCreatedAt()          Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()          Returns the current record's "updated_at" value
 * @method People    getPeople()             Returns the current record's "People" value
 * @method Profiles  setProfileName()        Sets the current record's "profile_name" value
 * @method Profiles  setPersonId()           Sets the current record's "person_id" value
 * @method Profiles  setFirstName()          Sets the current record's "first_name" value
 * @method Profiles  setLastName()           Sets the current record's "last_name" value
 * @method Profiles  setPictureUrl()         Sets the current record's "picture_url" value
 * @method Profiles  setPictureUrlLarge()    Sets the current record's "picture_url_large" value
 * @method Profiles  setPictureUrlMedium()   Sets the current record's "picture_url_medium" value
 * @method Profiles  setPictureUrlSmall()    Sets the current record's "picture_url_small" value
 * @method Profiles  setPictureUrlTiny()     Sets the current record's "picture_url_tiny" value
 * @method Profiles  setAddress1()           Sets the current record's "address1" value
 * @method Profiles  setAddress2()           Sets the current record's "address2" value
 * @method Profiles  setCity()               Sets the current record's "city" value
 * @method Profiles  setState()              Sets the current record's "state" value
 * @method Profiles  setPostalCode()         Sets the current record's "postal_code" value
 * @method Profiles  setCountry()            Sets the current record's "country" value
 * @method Profiles  setBirthday()           Sets the current record's "birthday" value
 * @method Profiles  setGender()             Sets the current record's "gender" value
 * @method Profiles  setAboutMe()            Sets the current record's "about_me" value
 * @method Profiles  setTop5()               Sets the current record's "top5" value
 * @method Profiles  setWantsToTravelTo()    Sets the current record's "wants_to_travel_to" value
 * @method Profiles  setMusic()              Sets the current record's "music" value
 * @method Profiles  setMovies()             Sets the current record's "movies" value
 * @method Profiles  setBooks()              Sets the current record's "books" value
 * @method Profiles  setInterests()          Sets the current record's "interests" value
 * @method Profiles  setFavoriteWebsites()   Sets the current record's "favorite_websites" value
 * @method Profiles  setWebsiteUrl()         Sets the current record's "website_url" value
 * @method Profiles  setFacebookUserName()   Sets the current record's "facebook_user_name" value
 * @method Profiles  setTwitterUserName()    Sets the current record's "twitter_user_name" value
 * @method Profiles  setCreatedAt()          Sets the current record's "created_at" value
 * @method Profiles  setUpdatedAt()          Sets the current record's "updated_at" value
 * @method Profiles  setPeople()             Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfiles extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profiles');
        $this->hasColumn('profile_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('person_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('first_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('last_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('picture_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('picture_url_large', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('picture_url_medium', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('picture_url_small', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('picture_url_tiny', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('address1', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('address2', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('city', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('state', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('postal_code', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('country', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('birthday', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('gender', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('about_me', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('top5', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('wants_to_travel_to', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('music', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('movies', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('books', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('interests', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('favorite_websites', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('website_url', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('facebook_user_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('twitter_user_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));
    }
}