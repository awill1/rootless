<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Drivers', 'doctrine');

/**
 * BaseDrivers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $driver_id
 * @property integer $person_id
 * @property integer $solo_route_id
 * @property integer $carpool_id
 * @property integer $seats_available
 * @property date $start_date
 * @property time $start_time
 * @property float $asking_price
 * @property string $description
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * @property Routes $Routes
 * @property Carpools $Carpools
 * 
 * @method integer   getDriverId()        Returns the current record's "driver_id" value
 * @method integer   getPersonId()        Returns the current record's "person_id" value
 * @method integer   getSoloRouteId()     Returns the current record's "solo_route_id" value
 * @method integer   getCarpoolId()       Returns the current record's "carpool_id" value
 * @method integer   getSeatsAvailable()  Returns the current record's "seats_available" value
 * @method date      getStartDate()       Returns the current record's "start_date" value
 * @method time      getStartTime()       Returns the current record's "start_time" value
 * @method float     getAskingPrice()     Returns the current record's "asking_price" value
 * @method string    getDescription()     Returns the current record's "description" value
 * @method timestamp getCreatedAt()       Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()       Returns the current record's "updated_at" value
 * @method People    getPeople()          Returns the current record's "People" value
 * @method Routes    getRoutes()          Returns the current record's "Routes" value
 * @method Carpools  getCarpools()        Returns the current record's "Carpools" value
 * @method Drivers   setDriverId()        Sets the current record's "driver_id" value
 * @method Drivers   setPersonId()        Sets the current record's "person_id" value
 * @method Drivers   setSoloRouteId()     Sets the current record's "solo_route_id" value
 * @method Drivers   setCarpoolId()       Sets the current record's "carpool_id" value
 * @method Drivers   setSeatsAvailable()  Sets the current record's "seats_available" value
 * @method Drivers   setStartDate()       Sets the current record's "start_date" value
 * @method Drivers   setStartTime()       Sets the current record's "start_time" value
 * @method Drivers   setAskingPrice()     Sets the current record's "asking_price" value
 * @method Drivers   setDescription()     Sets the current record's "description" value
 * @method Drivers   setCreatedAt()       Sets the current record's "created_at" value
 * @method Drivers   setUpdatedAt()       Sets the current record's "updated_at" value
 * @method Drivers   setPeople()          Sets the current record's "People" value
 * @method Drivers   setRoutes()          Sets the current record's "Routes" value
 * @method Drivers   setCarpools()        Sets the current record's "Carpools" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseDrivers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('drivers');
        $this->hasColumn('driver_id', 'integer', 4, array(
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
        $this->hasColumn('carpool_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('seats_available', 'integer', 4, array(
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
             'notnull' => true,
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

        $this->hasOne('Carpools', array(
             'local' => 'carpool_id',
             'foreign' => 'carpool_id'));
    }
}