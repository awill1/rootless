<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Profiles', 'doctrine');

/**
 * BaseProfiles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $idprofile
 * @property string $firstname
 * @property string $lastname
 * @property string $pictureurl
 * @property string $pictureurllarge
 * @property string $pictureurlmedium
 * @property string $pictureurlsmall
 * @property string $pictureurltiny
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postalcode
 * @property string $country
 * @property date $birthday
 * @property string $gender
 * @property string $aboutme
 * @property string $top5
 * @property string $wantstotravelto
 * @property string $music
 * @property string $movies
 * @property string $books
 * @property string $interests
 * @property string $favoritewebsites
 * @property string $websiteurl
 * @property string $facebookusername
 * @property string $twitterusername
 * @property timestamp $createdon
 * @property timestamp $modifiedon
 * @property string $users_username
 * @property Users $Users
 * @property Doctrine_Collection $Events
 * @property Doctrine_Collection $Friendships
 * @property Doctrine_Collection $Friendships_2
 * @property Doctrine_Collection $Messagerecipients
 * @property Doctrine_Collection $Messages
 * @property Doctrine_Collection $Reviews
 * @property Doctrine_Collection $Reviews_2
 * @property Doctrine_Collection $Rideofferposts
 * @property Doctrine_Collection $Seatneededposts
 * @property Doctrine_Collection $Seatrequests
 * @property Doctrine_Collection $Seatrequests_2
 * @property Doctrine_Collection $TravelersAttendingEvent
 * @property Doctrine_Collection $Vehicles
 * 
 * @method string              getIdprofile()               Returns the current record's "idprofile" value
 * @method string              getFirstname()               Returns the current record's "firstname" value
 * @method string              getLastname()                Returns the current record's "lastname" value
 * @method string              getPictureurl()              Returns the current record's "pictureurl" value
 * @method string              getPictureurllarge()         Returns the current record's "pictureurllarge" value
 * @method string              getPictureurlmedium()        Returns the current record's "pictureurlmedium" value
 * @method string              getPictureurlsmall()         Returns the current record's "pictureurlsmall" value
 * @method string              getPictureurltiny()          Returns the current record's "pictureurltiny" value
 * @method string              getAddress1()                Returns the current record's "address1" value
 * @method string              getAddress2()                Returns the current record's "address2" value
 * @method string              getCity()                    Returns the current record's "city" value
 * @method string              getState()                   Returns the current record's "state" value
 * @method string              getPostalcode()              Returns the current record's "postalcode" value
 * @method string              getCountry()                 Returns the current record's "country" value
 * @method date                getBirthday()                Returns the current record's "birthday" value
 * @method string              getGender()                  Returns the current record's "gender" value
 * @method string              getAboutme()                 Returns the current record's "aboutme" value
 * @method string              getTop5()                    Returns the current record's "top5" value
 * @method string              getWantstotravelto()         Returns the current record's "wantstotravelto" value
 * @method string              getMusic()                   Returns the current record's "music" value
 * @method string              getMovies()                  Returns the current record's "movies" value
 * @method string              getBooks()                   Returns the current record's "books" value
 * @method string              getInterests()               Returns the current record's "interests" value
 * @method string              getFavoritewebsites()        Returns the current record's "favoritewebsites" value
 * @method string              getWebsiteurl()              Returns the current record's "websiteurl" value
 * @method string              getFacebookusername()        Returns the current record's "facebookusername" value
 * @method string              getTwitterusername()         Returns the current record's "twitterusername" value
 * @method timestamp           getCreatedon()               Returns the current record's "createdon" value
 * @method timestamp           getModifiedon()              Returns the current record's "modifiedon" value
 * @method string              getUsersUsername()           Returns the current record's "users_username" value
 * @method Users               getUsers()                   Returns the current record's "Users" value
 * @method Doctrine_Collection getEvents()                  Returns the current record's "Events" collection
 * @method Doctrine_Collection getFriendships()             Returns the current record's "Friendships" collection
 * @method Doctrine_Collection getFriendships2()            Returns the current record's "Friendships_2" collection
 * @method Doctrine_Collection getMessagerecipients()       Returns the current record's "Messagerecipients" collection
 * @method Doctrine_Collection getMessages()                Returns the current record's "Messages" collection
 * @method Doctrine_Collection getReviews()                 Returns the current record's "Reviews" collection
 * @method Doctrine_Collection getReviews2()                Returns the current record's "Reviews_2" collection
 * @method Doctrine_Collection getRideofferposts()          Returns the current record's "Rideofferposts" collection
 * @method Doctrine_Collection getSeatneededposts()         Returns the current record's "Seatneededposts" collection
 * @method Doctrine_Collection getSeatrequests()            Returns the current record's "Seatrequests" collection
 * @method Doctrine_Collection getSeatrequests2()           Returns the current record's "Seatrequests_2" collection
 * @method Doctrine_Collection getTravelersAttendingEvent() Returns the current record's "TravelersAttendingEvent" collection
 * @method Doctrine_Collection getVehicles()                Returns the current record's "Vehicles" collection
 * @method Profiles            setIdprofile()               Sets the current record's "idprofile" value
 * @method Profiles            setFirstname()               Sets the current record's "firstname" value
 * @method Profiles            setLastname()                Sets the current record's "lastname" value
 * @method Profiles            setPictureurl()              Sets the current record's "pictureurl" value
 * @method Profiles            setPictureurllarge()         Sets the current record's "pictureurllarge" value
 * @method Profiles            setPictureurlmedium()        Sets the current record's "pictureurlmedium" value
 * @method Profiles            setPictureurlsmall()         Sets the current record's "pictureurlsmall" value
 * @method Profiles            setPictureurltiny()          Sets the current record's "pictureurltiny" value
 * @method Profiles            setAddress1()                Sets the current record's "address1" value
 * @method Profiles            setAddress2()                Sets the current record's "address2" value
 * @method Profiles            setCity()                    Sets the current record's "city" value
 * @method Profiles            setState()                   Sets the current record's "state" value
 * @method Profiles            setPostalcode()              Sets the current record's "postalcode" value
 * @method Profiles            setCountry()                 Sets the current record's "country" value
 * @method Profiles            setBirthday()                Sets the current record's "birthday" value
 * @method Profiles            setGender()                  Sets the current record's "gender" value
 * @method Profiles            setAboutme()                 Sets the current record's "aboutme" value
 * @method Profiles            setTop5()                    Sets the current record's "top5" value
 * @method Profiles            setWantstotravelto()         Sets the current record's "wantstotravelto" value
 * @method Profiles            setMusic()                   Sets the current record's "music" value
 * @method Profiles            setMovies()                  Sets the current record's "movies" value
 * @method Profiles            setBooks()                   Sets the current record's "books" value
 * @method Profiles            setInterests()               Sets the current record's "interests" value
 * @method Profiles            setFavoritewebsites()        Sets the current record's "favoritewebsites" value
 * @method Profiles            setWebsiteurl()              Sets the current record's "websiteurl" value
 * @method Profiles            setFacebookusername()        Sets the current record's "facebookusername" value
 * @method Profiles            setTwitterusername()         Sets the current record's "twitterusername" value
 * @method Profiles            setCreatedon()               Sets the current record's "createdon" value
 * @method Profiles            setModifiedon()              Sets the current record's "modifiedon" value
 * @method Profiles            setUsersUsername()           Sets the current record's "users_username" value
 * @method Profiles            setUsers()                   Sets the current record's "Users" value
 * @method Profiles            setEvents()                  Sets the current record's "Events" collection
 * @method Profiles            setFriendships()             Sets the current record's "Friendships" collection
 * @method Profiles            setFriendships2()            Sets the current record's "Friendships_2" collection
 * @method Profiles            setMessagerecipients()       Sets the current record's "Messagerecipients" collection
 * @method Profiles            setMessages()                Sets the current record's "Messages" collection
 * @method Profiles            setReviews()                 Sets the current record's "Reviews" collection
 * @method Profiles            setReviews2()                Sets the current record's "Reviews_2" collection
 * @method Profiles            setRideofferposts()          Sets the current record's "Rideofferposts" collection
 * @method Profiles            setSeatneededposts()         Sets the current record's "Seatneededposts" collection
 * @method Profiles            setSeatrequests()            Sets the current record's "Seatrequests" collection
 * @method Profiles            setSeatrequests2()           Sets the current record's "Seatrequests_2" collection
 * @method Profiles            setTravelersAttendingEvent() Sets the current record's "TravelersAttendingEvent" collection
 * @method Profiles            setVehicles()                Sets the current record's "Vehicles" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseProfiles extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profiles');
        $this->hasColumn('idprofile', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('firstname', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('lastname', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('pictureurl', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('pictureurllarge', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('pictureurlmedium', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('pictureurlsmall', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('pictureurltiny', 'string', 255, array(
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
        $this->hasColumn('postalcode', 'string', 45, array(
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
        $this->hasColumn('aboutme', 'string', null, array(
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
        $this->hasColumn('wantstotravelto', 'string', null, array(
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
        $this->hasColumn('favoritewebsites', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('websiteurl', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('facebookusername', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('twitterusername', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('createdon', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('modifiedon', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('users_username', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users', array(
             'local' => 'users_username',
             'foreign' => 'username'));

        $this->hasMany('Events', array(
             'local' => 'idprofile',
             'foreign' => 'createdby'));

        $this->hasMany('Friendships', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idusers'));

        $this->hasMany('Friendships as Friendships_2', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idusers1'));

        $this->hasMany('Messagerecipients', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idtraveler'));

        $this->hasMany('Messages', array(
             'local' => 'idprofile',
             'foreign' => 'sender'));

        $this->hasMany('Reviews', array(
             'local' => 'idprofile',
             'foreign' => 'reviewer'));

        $this->hasMany('Reviews as Reviews_2', array(
             'local' => 'idprofile',
             'foreign' => 'reviewee'));

        $this->hasMany('Rideofferposts', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idusers'));

        $this->hasMany('Seatneededposts', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idusers'));

        $this->hasMany('Seatrequests', array(
             'local' => 'idprofile',
             'foreign' => 'driverid'));

        $this->hasMany('Seatrequests as Seatrequests_2', array(
             'local' => 'idprofile',
             'foreign' => 'passengerid'));

        $this->hasMany('TravelersAttendingEvent', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idtraveler'));

        $this->hasMany('Vehicles', array(
             'local' => 'idprofile',
             'foreign' => 'travelers_idusers'));
    }
}