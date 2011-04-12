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
 * @property integer $seat_negotiation_id
 * @property float $price
 * @property integer $seat_count
 * @property date $pickup_date
 * @property time $pickup_time
 * @property string $description
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Carpools $Carpools
 * @property SeatNegotiations $SeatNegotiations
 * @property Doctrine_Collection $Passengers
 * @property Doctrine_Collection $SeatsFilledLegs
 * 
 * @method integer             getSeatId()              Returns the current record's "seat_id" value
 * @method integer             getCarpoolId()           Returns the current record's "carpool_id" value
 * @method integer             getSeatNegotiationId()   Returns the current record's "seat_negotiation_id" value
 * @method float               getPrice()               Returns the current record's "price" value
 * @method integer             getSeatCount()           Returns the current record's "seat_count" value
 * @method date                getPickupDate()          Returns the current record's "pickup_date" value
 * @method time                getPickupTime()          Returns the current record's "pickup_time" value
 * @method string              getDescription()         Returns the current record's "description" value
 * @method timestamp           getCreatedAt()           Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()           Returns the current record's "updated_at" value
 * @method Carpools            getCarpools()            Returns the current record's "Carpools" value
 * @method SeatNegotiations    getSeatNegotiations()    Returns the current record's "SeatNegotiations" value
 * @method Doctrine_Collection getPassengers()          Returns the current record's "Passengers" collection
 * @method Doctrine_Collection getSeatsFilledLegs()     Returns the current record's "SeatsFilledLegs" collection
 * @method Seats               setSeatId()              Sets the current record's "seat_id" value
 * @method Seats               setCarpoolId()           Sets the current record's "carpool_id" value
 * @method Seats               setSeatNegotiationId()   Sets the current record's "seat_negotiation_id" value
 * @method Seats               setPrice()               Sets the current record's "price" value
 * @method Seats               setSeatCount()           Sets the current record's "seat_count" value
 * @method Seats               setPickupDate()          Sets the current record's "pickup_date" value
 * @method Seats               setPickupTime()          Sets the current record's "pickup_time" value
 * @method Seats               setDescription()         Sets the current record's "description" value
 * @method Seats               setCreatedAt()           Sets the current record's "created_at" value
 * @method Seats               setUpdatedAt()           Sets the current record's "updated_at" value
 * @method Seats               setCarpools()            Sets the current record's "Carpools" value
 * @method Seats               setSeatNegotiations()    Sets the current record's "SeatNegotiations" value
 * @method Seats               setPassengers()          Sets the current record's "Passengers" collection
 * @method Seats               setSeatsFilledLegs()     Sets the current record's "SeatsFilledLegs" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
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
        $this->hasColumn('seat_negotiation_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
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

        $this->hasOne('SeatNegotiations', array(
             'local' => 'seat_negotiation_id',
             'foreign' => 'seat_negotiation_id'));

        $this->hasMany('Passengers', array(
             'local' => 'seat_id',
             'foreign' => 'seat_id'));

        $this->hasMany('SeatsFilledLegs', array(
             'local' => 'seat_id',
             'foreign' => 'seats_seat_id'));
    }
}