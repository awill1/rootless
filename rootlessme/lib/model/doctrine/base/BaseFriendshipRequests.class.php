<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('FriendshipRequests', 'doctrine');

/**
 * BaseFriendshipRequests
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $requestor_id
 * @property integer $requestee_id
 * @property integer $friendship_status_id
 * @property integer $abuse
 * @property string $abuse_comment
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * @property People $People_2
 * @property FriendshipStatuses $FriendshipStatuses
 * 
 * @method integer            getRequestorId()          Returns the current record's "requestor_id" value
 * @method integer            getRequesteeId()          Returns the current record's "requestee_id" value
 * @method integer            getFriendshipStatusId()   Returns the current record's "friendship_status_id" value
 * @method integer            getAbuse()                Returns the current record's "abuse" value
 * @method string             getAbuseComment()         Returns the current record's "abuse_comment" value
 * @method timestamp          getCreatedAt()            Returns the current record's "created_at" value
 * @method timestamp          getUpdatedAt()            Returns the current record's "updated_at" value
 * @method People             getPeople()               Returns the current record's "People" value
 * @method People             getPeople2()              Returns the current record's "People_2" value
 * @method FriendshipStatuses getFriendshipStatuses()   Returns the current record's "FriendshipStatuses" value
 * @method FriendshipRequests setRequestorId()          Sets the current record's "requestor_id" value
 * @method FriendshipRequests setRequesteeId()          Sets the current record's "requestee_id" value
 * @method FriendshipRequests setFriendshipStatusId()   Sets the current record's "friendship_status_id" value
 * @method FriendshipRequests setAbuse()                Sets the current record's "abuse" value
 * @method FriendshipRequests setAbuseComment()         Sets the current record's "abuse_comment" value
 * @method FriendshipRequests setCreatedAt()            Sets the current record's "created_at" value
 * @method FriendshipRequests setUpdatedAt()            Sets the current record's "updated_at" value
 * @method FriendshipRequests setPeople()               Sets the current record's "People" value
 * @method FriendshipRequests setPeople2()              Sets the current record's "People_2" value
 * @method FriendshipRequests setFriendshipStatuses()   Sets the current record's "FriendshipStatuses" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFriendshipRequests extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('friendship_requests');
        $this->hasColumn('requestor_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('requestee_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('friendship_status_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('abuse', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('abuse_comment', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
             'local' => 'requestor_id',
             'foreign' => 'person_id'));

        $this->hasOne('People as People_2', array(
             'local' => 'requestee_id',
             'foreign' => 'person_id'));

        $this->hasOne('FriendshipStatuses', array(
             'local' => 'friendship_status_id',
             'foreign' => 'friendship_status_id'));
    }
}