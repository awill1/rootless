<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('People', 'doctrine');

/**
 * BasePeople
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $person_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Doctrine_Collection $Carpools
 * @property Doctrine_Collection $Comments
 * @property Doctrine_Collection $ConversationParticipants
 * @property Doctrine_Collection $Conversations
 * @property Doctrine_Collection $FriendshipRequests
 * @property Doctrine_Collection $FriendshipRequests_2
 * @property Doctrine_Collection $Friendships
 * @property Doctrine_Collection $Friendships_2
 * @property Doctrine_Collection $Messages
 * @property Doctrine_Collection $Passengers
 * @property Doctrine_Collection $Profiles
 * @property Doctrine_Collection $Reviews
 * @property Doctrine_Collection $Reviews_2
 * @property Doctrine_Collection $SecuritySettings
 * @property Doctrine_Collection $sfGuardUser
 * @property Doctrine_Collection $TravelersAttendingEvent
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Vehicles
 * @property Doctrine_Collection $MessageRecipients
 * 
 * @method integer             getPersonId()                 Returns the current record's "person_id" value
 * @method timestamp           getCreatedAt()                Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()                Returns the current record's "updated_at" value
 * @method Doctrine_Collection getCarpools()                 Returns the current record's "Carpools" collection
 * @method Doctrine_Collection getComments()                 Returns the current record's "Comments" collection
 * @method Doctrine_Collection getConversationParticipants() Returns the current record's "ConversationParticipants" collection
 * @method Doctrine_Collection getConversations()            Returns the current record's "Conversations" collection
 * @method Doctrine_Collection getFriendshipRequests()       Returns the current record's "FriendshipRequests" collection
 * @method Doctrine_Collection getFriendshipRequests2()      Returns the current record's "FriendshipRequests_2" collection
 * @method Doctrine_Collection getFriendships()              Returns the current record's "Friendships" collection
 * @method Doctrine_Collection getFriendships2()             Returns the current record's "Friendships_2" collection
 * @method Doctrine_Collection getMessages()                 Returns the current record's "Messages" collection
 * @method Doctrine_Collection getPassengers()               Returns the current record's "Passengers" collection
 * @method Doctrine_Collection getProfiles()                 Returns the current record's "Profiles" collection
 * @method Doctrine_Collection getReviews()                  Returns the current record's "Reviews" collection
 * @method Doctrine_Collection getReviews2()                 Returns the current record's "Reviews_2" collection
 * @method Doctrine_Collection getSecuritySettings()         Returns the current record's "SecuritySettings" collection
 * @method Doctrine_Collection getSfGuardUser()              Returns the current record's "sfGuardUser" collection
 * @method Doctrine_Collection getTravelersAttendingEvent()  Returns the current record's "TravelersAttendingEvent" collection
 * @method Doctrine_Collection getUsers()                    Returns the current record's "Users" collection
 * @method Doctrine_Collection getVehicles()                 Returns the current record's "Vehicles" collection
 * @method Doctrine_Collection getMessageRecipients()        Returns the current record's "MessageRecipients" collection
 * @method People              setPersonId()                 Sets the current record's "person_id" value
 * @method People              setCreatedAt()                Sets the current record's "created_at" value
 * @method People              setUpdatedAt()                Sets the current record's "updated_at" value
 * @method People              setCarpools()                 Sets the current record's "Carpools" collection
 * @method People              setComments()                 Sets the current record's "Comments" collection
 * @method People              setConversationParticipants() Sets the current record's "ConversationParticipants" collection
 * @method People              setConversations()            Sets the current record's "Conversations" collection
 * @method People              setFriendshipRequests()       Sets the current record's "FriendshipRequests" collection
 * @method People              setFriendshipRequests2()      Sets the current record's "FriendshipRequests_2" collection
 * @method People              setFriendships()              Sets the current record's "Friendships" collection
 * @method People              setFriendships2()             Sets the current record's "Friendships_2" collection
 * @method People              setMessages()                 Sets the current record's "Messages" collection
 * @method People              setPassengers()               Sets the current record's "Passengers" collection
 * @method People              setProfiles()                 Sets the current record's "Profiles" collection
 * @method People              setReviews()                  Sets the current record's "Reviews" collection
 * @method People              setReviews2()                 Sets the current record's "Reviews_2" collection
 * @method People              setSecuritySettings()         Sets the current record's "SecuritySettings" collection
 * @method People              setSfGuardUser()              Sets the current record's "sfGuardUser" collection
 * @method People              setTravelersAttendingEvent()  Sets the current record's "TravelersAttendingEvent" collection
 * @method People              setUsers()                    Sets the current record's "Users" collection
 * @method People              setVehicles()                 Sets the current record's "Vehicles" collection
 * @method People              setMessageRecipients()        Sets the current record's "MessageRecipients" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePeople extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('people');
        $this->hasColumn('person_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
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
        $this->hasMany('Carpools', array(
             'local' => 'person_id',
             'foreign' => 'driver_id'));

        $this->hasMany('Comments', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('ConversationParticipants', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('Conversations', array(
             'local' => 'person_id',
             'foreign' => 'author_id'));

        $this->hasMany('FriendshipRequests', array(
             'local' => 'person_id',
             'foreign' => 'requestor_id'));

        $this->hasMany('FriendshipRequests as FriendshipRequests_2', array(
             'local' => 'person_id',
             'foreign' => 'requestee_id'));

        $this->hasMany('Friendships', array(
             'local' => 'person_id',
             'foreign' => 'friend1_id'));

        $this->hasMany('Friendships as Friendships_2', array(
             'local' => 'person_id',
             'foreign' => 'friend2_id'));

        $this->hasMany('Messages', array(
             'local' => 'person_id',
             'foreign' => 'author_id'));

        $this->hasMany('Passengers', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('Profiles', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('Reviews', array(
             'local' => 'person_id',
             'foreign' => 'reviewer_id'));

        $this->hasMany('Reviews as Reviews_2', array(
             'local' => 'person_id',
             'foreign' => 'reviewee_id'));

        $this->hasMany('SecuritySettings', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('sfGuardUser', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('TravelersAttendingEvent', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('Users', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('Vehicles', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasMany('MessageRecipients', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}