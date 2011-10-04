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
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Doctrine_Collection $Carpools
 * @property Doctrine_Collection $Carpools_3
 * @property Doctrine_Collection $Legs
 * @property Doctrine_Collection $Passengers
 * @property Doctrine_Collection $Seats
 * 
 * @method integer             getRouteId()          Returns the current record's "route_id" value
 * @method string              getCopyright()        Returns the current record's "copyright" value
 * @method string              getSummary()          Returns the current record's "summary" value
 * @method string              getWarning()          Returns the current record's "warning" value
 * @method string              getEncodedPolyline()  Returns the current record's "encoded_polyline" value
 * @method timestamp           getCreatedAt()        Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()        Returns the current record's "updated_at" value
 * @method Doctrine_Collection getCarpools()         Returns the current record's "Carpools" collection
 * @method Doctrine_Collection getCarpools3()        Returns the current record's "Carpools_3" collection
 * @method Doctrine_Collection getLegs()             Returns the current record's "Legs" collection
 * @method Doctrine_Collection getPassengers()       Returns the current record's "Passengers" collection
 * @method Doctrine_Collection getSeats()            Returns the current record's "Seats" collection
 * @method Routes              setRouteId()          Sets the current record's "route_id" value
 * @method Routes              setCopyright()        Sets the current record's "copyright" value
 * @method Routes              setSummary()          Sets the current record's "summary" value
 * @method Routes              setWarning()          Sets the current record's "warning" value
 * @method Routes              setEncodedPolyline()  Sets the current record's "encoded_polyline" value
 * @method Routes              setCreatedAt()        Sets the current record's "created_at" value
 * @method Routes              setUpdatedAt()        Sets the current record's "updated_at" value
 * @method Routes              setCarpools()         Sets the current record's "Carpools" collection
 * @method Routes              setCarpools3()        Sets the current record's "Carpools_3" collection
 * @method Routes              setLegs()             Sets the current record's "Legs" collection
 * @method Routes              setPassengers()       Sets the current record's "Passengers" collection
 * @method Routes              setSeats()            Sets the current record's "Seats" collection
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

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}