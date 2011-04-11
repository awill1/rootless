<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Friendships', 'doctrine');

/**
 * BaseFriendships
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $travelers_idusers
 * @property string $travelers_idusers1
 * @property integer $pending
 * @property string $initiatedby
 * @property string $createdon
 * @property Profiles $Profiles
 * @property Profiles $Profiles_2
 * 
 * @method string      getTravelersIdusers()   Returns the current record's "travelers_idusers" value
 * @method string      getTravelersIdusers1()  Returns the current record's "travelers_idusers1" value
 * @method integer     getPending()            Returns the current record's "pending" value
 * @method string      getInitiatedby()        Returns the current record's "initiatedby" value
 * @method string      getCreatedon()          Returns the current record's "createdon" value
 * @method Profiles    getProfiles()           Returns the current record's "Profiles" value
 * @method Profiles    getProfiles2()          Returns the current record's "Profiles_2" value
 * @method Friendships setTravelersIdusers()   Sets the current record's "travelers_idusers" value
 * @method Friendships setTravelersIdusers1()  Sets the current record's "travelers_idusers1" value
 * @method Friendships setPending()            Sets the current record's "pending" value
 * @method Friendships setInitiatedby()        Sets the current record's "initiatedby" value
 * @method Friendships setCreatedon()          Sets the current record's "createdon" value
 * @method Friendships setProfiles()           Sets the current record's "Profiles" value
 * @method Friendships setProfiles2()          Sets the current record's "Profiles_2" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseFriendships extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('friendships');
        $this->hasColumn('travelers_idusers', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('travelers_idusers1', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('pending', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('initiatedby', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('createdon', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Profiles', array(
             'local' => 'travelers_idusers',
             'foreign' => 'idprofile'));

        $this->hasOne('Profiles as Profiles_2', array(
             'local' => 'travelers_idusers1',
             'foreign' => 'idprofile'));
    }
}