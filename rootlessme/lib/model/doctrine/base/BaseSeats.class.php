<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Seats', 'doctrine');

/**
 * BaseSeats
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $seat_id
 * @property integer $carpool_id
 * @property integer $passenger_id
 * @property integer $seat_status_id
 * @property integer $solo_route_id
 * @property float $price
 * @property integer $seat_count
 * @property date $pickup_date
 * @property time $pickup_time
 * @property string $description
 * @property boolean $is_hidden_for_driver
 * @property boolean $is_hidden_for_passenger
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Carpools $Carpools
 * @property SeatStatuses $SeatStatuses
 * @property Passengers $Passengers
 * @property Doctrine_Collection $SeatsHistory
 * @property Routes $Routes
 * @property Doctrine_Collection $Reviews
 * 
 * @method integer             getSeatId()                  Returns the current record's "seat_id" value
 * @method integer             getCarpoolId()               Returns the current record's "carpool_id" value
 * @method integer             getPassengerId()             Returns the current record's "passenger_id" value
 * @method integer             getSeatStatusId()            Returns the current record's "seat_status_id" value
 * @method integer             getSoloRouteId()             Returns the current record's "solo_route_id" value
 * @method float               getPrice()                   Returns the current record's "price" value
 * @method integer             getSeatCount()               Returns the current record's "seat_count" value
 * @method date                getPickupDate()              Returns the current record's "pickup_date" value
 * @method time                getPickupTime()              Returns the current record's "pickup_time" value
 * @method string              getDescription()             Returns the current record's "description" value
 * @method boolean             getIsHiddenForDriver()       Returns the current record's "is_hidden_for_driver" value
 * @method boolean             getIsHiddenForPassenger()    Returns the current record's "is_hidden_for_passenger" value
 * @method timestamp           getCreatedAt()               Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()               Returns the current record's "updated_at" value
 * @method Carpools            getCarpools()                Returns the current record's "Carpools" value
 * @method SeatStatuses        getSeatStatuses()            Returns the current record's "SeatStatuses" value
 * @method Passengers          getPassengers()              Returns the current record's "Passengers" value
 * @method Doctrine_Collection getSeatsHistory()            Returns the current record's "SeatsHistory" collection
 * @method Routes              getRoutes()                  Returns the current record's "Routes" value
 * @method Doctrine_Collection getReviews()                 Returns the current record's "Reviews" collection
 * @method Seats               setSeatId()                  Sets the current record's "seat_id" value
 * @method Seats               setCarpoolId()               Sets the current record's "carpool_id" value
 * @method Seats               setPassengerId()             Sets the current record's "passenger_id" value
 * @method Seats               setSeatStatusId()            Sets the current record's "seat_status_id" value
 * @method Seats               setSoloRouteId()             Sets the current record's "solo_route_id" value
 * @method Seats               setPrice()                   Sets the current record's "price" value
 * @method Seats               setSeatCount()               Sets the current record's "seat_count" value
 * @method Seats               setPickupDate()              Sets the current record's "pickup_date" value
 * @method Seats               setPickupTime()              Sets the current record's "pickup_time" value
 * @method Seats               setDescription()             Sets the current record's "description" value
 * @method Seats               setIsHiddenForDriver()       Sets the current record's "is_hidden_for_driver" value
 * @method Seats               setIsHiddenForPassenger()    Sets the current record's "is_hidden_for_passenger" value
 * @method Seats               setCreatedAt()               Sets the current record's "created_at" value
 * @method Seats               setUpdatedAt()               Sets the current record's "updated_at" value
 * @method Seats               setCarpools()                Sets the current record's "Carpools" value
 * @method Seats               setSeatStatuses()            Sets the current record's "SeatStatuses" value
 * @method Seats               setPassengers()              Sets the current record's "Passengers" value
 * @method Seats               setSeatsHistory()            Sets the current record's "SeatsHistory" collection
 * @method Seats               setRoutes()                  Sets the current record's "Routes" value
 * @method Seats               setReviews()                 Sets the current record's "Reviews" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSeats extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('seats');
        $this->hasColumn('seat_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('passenger_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('seat_status_id', 'integer', 4, array(
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
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('price', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('seat_count', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('pickup_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('pickup_time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
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
        $this->hasColumn('is_hidden_for_driver', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'default' => false,
             ));
        $this->hasColumn('is_hidden_for_passenger', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'default' => false,
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
        $this->hasOne('Carpools', array(
             'local' => 'carpool_id',
             'foreign' => 'carpool_id'));

        $this->hasOne('SeatStatuses', array(
             'local' => 'seat_status_id',
             'foreign' => 'seat_status_id'));

        $this->hasOne('Passengers', array(
             'local' => 'passenger_id',
             'foreign' => 'passenger_id'));

        $this->hasMany('SeatsHistory', array(
             'local' => 'seat_id',
             'foreign' => 'seat_id'));

        $this->hasOne('Routes', array(
             'local' => 'solo_route_id',
             'foreign' => 'route_id'));

        $this->hasMany('Reviews', array(
             'local' => 'seat_id',
             'foreign' => 'seat_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}