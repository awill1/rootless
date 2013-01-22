<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Routes', 'doctrine');

/**
 * BaseRoutes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $route_id
 * @property string $copyright
 * @property string $summary
 * @property string $warning
 * @property string $encoded_polyline
 * @property string $origin_address
 * @property string $origin_city
 * @property string $origin_state
 * @property float $origin_latitude
 * @property float $origin_longitude
 * @property integer $origin_place_id
 * @property string $destination_address
 * @property string $destination_city
 * @property string $destination_state
 * @property float $destination_latitude
 * @property float $destination_longitude
 * @property integer $destination_place_id
 * @property integer $distance
 * @property integer $duration
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Doctrine_Collection $Carpools
 * @property Doctrine_Collection $Carpools_3
 * @property Doctrine_Collection $Legs
 * @property Doctrine_Collection $Passengers
 * @property Doctrine_Collection $Seats
 * @property Doctrine_Collection $SeatsHistory
 * @property Places $Origin_Places
 * @property Places $Destination_Places
 * 
 * @method integer             getRouteId()               Returns the current record's "route_id" value
 * @method string              getCopyright()             Returns the current record's "copyright" value
 * @method string              getSummary()               Returns the current record's "summary" value
 * @method string              getWarning()               Returns the current record's "warning" value
 * @method string              getEncodedPolyline()       Returns the current record's "encoded_polyline" value
 * @method string              getOriginAddress()         Returns the current record's "origin_address" value
 * @method string              getOriginCity()            Returns the current record's "origin_city" value
 * @method string              getOriginState()           Returns the current record's "origin_state" value
 * @method float               getOriginLatitude()        Returns the current record's "origin_latitude" value
 * @method float               getOriginLongitude()       Returns the current record's "origin_longitude" value
 * @method integer             getOriginPlaceId()         Returns the current record's "origin_place_id" value
 * @method string              getDestinationAddress()    Returns the current record's "destination_address" value
 * @method string              getDestinationCity()       Returns the current record's "destination_city" value
 * @method string              getDestinationState()      Returns the current record's "destination_state" value
 * @method float               getDestinationLatitude()   Returns the current record's "destination_latitude" value
 * @method float               getDestinationLongitude()  Returns the current record's "destination_longitude" value
 * @method integer             getDestinationPlaceId()    Returns the current record's "destination_place_id" value
 * @method integer             getDistance()              Returns the current record's "distance" value
 * @method integer             getDuration()              Returns the current record's "duration" value
 * @method timestamp           getCreatedAt()             Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()             Returns the current record's "updated_at" value
 * @method Doctrine_Collection getCarpools()              Returns the current record's "Carpools" collection
 * @method Doctrine_Collection getCarpools3()             Returns the current record's "Carpools_3" collection
 * @method Doctrine_Collection getLegs()                  Returns the current record's "Legs" collection
 * @method Doctrine_Collection getPassengers()            Returns the current record's "Passengers" collection
 * @method Doctrine_Collection getSeats()                 Returns the current record's "Seats" collection
 * @method Doctrine_Collection getSeatsHistory()          Returns the current record's "SeatsHistory" collection
 * @method Places              getOriginPlaces()          Returns the current record's "Origin_Places" value
 * @method Places              getDestinationPlaces()     Returns the current record's "Destination_Places" value
 * @method Routes              setRouteId()               Sets the current record's "route_id" value
 * @method Routes              setCopyright()             Sets the current record's "copyright" value
 * @method Routes              setSummary()               Sets the current record's "summary" value
 * @method Routes              setWarning()               Sets the current record's "warning" value
 * @method Routes              setEncodedPolyline()       Sets the current record's "encoded_polyline" value
 * @method Routes              setOriginAddress()         Sets the current record's "origin_address" value
 * @method Routes              setOriginCity()            Sets the current record's "origin_city" value
 * @method Routes              setOriginState()           Sets the current record's "origin_state" value
 * @method Routes              setOriginLatitude()        Sets the current record's "origin_latitude" value
 * @method Routes              setOriginLongitude()       Sets the current record's "origin_longitude" value
 * @method Routes              setOriginPlaceId()         Sets the current record's "origin_place_id" value
 * @method Routes              setDestinationAddress()    Sets the current record's "destination_address" value
 * @method Routes              setDestinationCity()       Sets the current record's "destination_city" value
 * @method Routes              setDestinationState()      Sets the current record's "destination_state" value
 * @method Routes              setDestinationLatitude()   Sets the current record's "destination_latitude" value
 * @method Routes              setDestinationLongitude()  Sets the current record's "destination_longitude" value
 * @method Routes              setDestinationPlaceId()    Sets the current record's "destination_place_id" value
 * @method Routes              setDistance()              Sets the current record's "distance" value
 * @method Routes              setDuration()              Sets the current record's "duration" value
 * @method Routes              setCreatedAt()             Sets the current record's "created_at" value
 * @method Routes              setUpdatedAt()             Sets the current record's "updated_at" value
 * @method Routes              setCarpools()              Sets the current record's "Carpools" collection
 * @method Routes              setCarpools3()             Sets the current record's "Carpools_3" collection
 * @method Routes              setLegs()                  Sets the current record's "Legs" collection
 * @method Routes              setPassengers()            Sets the current record's "Passengers" collection
 * @method Routes              setSeats()                 Sets the current record's "Seats" collection
 * @method Routes              setSeatsHistory()          Sets the current record's "SeatsHistory" collection
 * @method Routes              setOriginPlaces()          Sets the current record's "Origin_Places" value
 * @method Routes              setDestinationPlaces()     Sets the current record's "Destination_Places" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRoutes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('routes');
        $this->hasColumn('route_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('copyright', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('summary', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('warning', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('encoded_polyline', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('origin_address', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('origin_city', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('origin_state', 'string', 2, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('origin_latitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('origin_longitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('origin_place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'autoincrement' => false,
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('destination_address', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('destination_city', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('destination_state', 'string', 2, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('destination_latitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('destination_longitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('destination_place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'autoincrement' => false,
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('distance', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('duration', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasMany('Carpools', array(
             'local' => 'route_id',
             'foreign' => 'route_id'));

        $this->hasMany('Carpools as Carpools_3', array(
             'local' => 'route_id',
             'foreign' => 'solo_route_id'));

        $this->hasMany('Legs', array(
             'local' => 'route_id',
             'foreign' => 'route_id'));

        $this->hasMany('Passengers', array(
             'local' => 'route_id',
             'foreign' => 'solo_route_id'));

        $this->hasMany('Seats', array(
             'local' => 'route_id',
             'foreign' => 'solo_route_id'));

        $this->hasMany('SeatsHistory', array(
             'local' => 'route_id',
             'foreign' => 'solo_route_id'));

        $this->hasOne('Places as Origin_Places', array(
             'local' => 'origin_place_id',
             'foreign' => 'place_id'));

        $this->hasOne('Places as Destination_Places', array(
             'local' => 'destination_place_id',
             'foreign' => 'place_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}