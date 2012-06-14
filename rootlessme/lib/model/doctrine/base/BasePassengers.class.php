<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Passengers', 'doctrine');

/**
 * BasePassengers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $passenger_id
 * @property integer $person_id
 * @property integer $solo_route_id
 * @property integer $passenger_count
 * @property date $start_date
 * @property time $start_time
 * @property float $asking_price
 * @property string $description
 * @property integer $isPublic
 * @property integer $status_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * @property Routes $Routes
 * @property Doctrine_Collection $Seats
 * 
 * @method integer             getPassengerId()     Returns the current record's "passenger_id" value
 * @method integer             getPersonId()        Returns the current record's "person_id" value
 * @method integer             getSoloRouteId()     Returns the current record's "solo_route_id" value
 * @method integer             getPassengerCount()  Returns the current record's "passenger_count" value
 * @method date                getStartDate()       Returns the current record's "start_date" value
 * @method time                getStartTime()       Returns the current record's "start_time" value
 * @method float               getAskingPrice()     Returns the current record's "asking_price" value
 * @method string              getDescription()     Returns the current record's "description" value
 * @method integer             getIsPublic()        Returns the current record's "isPublic" value
 * @method integer             getStatusId()        Returns the current record's "status_id" value
 * @method timestamp           getCreatedAt()       Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()       Returns the current record's "updated_at" value
 * @method People              getPeople()          Returns the current record's "People" value
 * @method Routes              getRoutes()          Returns the current record's "Routes" value
 * @method Doctrine_Collection getSeats()           Returns the current record's "Seats" collection
 * @method Passengers          setPassengerId()     Sets the current record's "passenger_id" value
 * @method Passengers          setPersonId()        Sets the current record's "person_id" value
 * @method Passengers          setSoloRouteId()     Sets the current record's "solo_route_id" value
 * @method Passengers          setPassengerCount()  Sets the current record's "passenger_count" value
 * @method Passengers          setStartDate()       Sets the current record's "start_date" value
 * @method Passengers          setStartTime()       Sets the current record's "start_time" value
 * @method Passengers          setAskingPrice()     Sets the current record's "asking_price" value
 * @method Passengers          setDescription()     Sets the current record's "description" value
 * @method Passengers          setIsPublic()        Sets the current record's "isPublic" value
 * @method Passengers          setStatusId()        Sets the current record's "status_id" value
 * @method Passengers          setCreatedAt()       Sets the current record's "created_at" value
 * @method Passengers          setUpdatedAt()       Sets the current record's "updated_at" value
 * @method Passengers          setPeople()          Sets the current record's "People" value
 * @method Passengers          setRoutes()          Sets the current record's "Routes" value
 * @method Passengers          setSeats()           Sets the current record's "Seats" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePassengers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('passengers');
        $this->hasColumn('passenger_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
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
        $this->hasColumn('solo_route_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('passenger_count', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('start_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('start_time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('asking_price', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('isPublic', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('status_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
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
        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $this->hasOne('Routes', array(
             'local' => 'solo_route_id',
             'foreign' => 'route_id'));

        $this->hasMany('Seats', array(
             'local' => 'passenger_id',
             'foreign' => 'passenger_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}