<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Locations', 'doctrine');

/**
 * BaseLocations
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $location_id
 * @property integer $step_id
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 * @property float $latitude
 * @property float $longitude
 * @property string $search_string
 * @property integer $sequence_order
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Steps $Steps
 * 
 * @method integer   getLocationId()     Returns the current record's "location_id" value
 * @method integer   getStepId()         Returns the current record's "step_id" value
 * @method string    getName()           Returns the current record's "name" value
 * @method string    getStreet1()        Returns the current record's "street1" value
 * @method string    getStreet2()        Returns the current record's "street2" value
 * @method string    getCity()           Returns the current record's "city" value
 * @method string    getState()          Returns the current record's "state" value
 * @method string    getPostalCode()     Returns the current record's "postal_code" value
 * @method string    getCountry()        Returns the current record's "country" value
 * @method float     getLatitude()       Returns the current record's "latitude" value
 * @method float     getLongitude()      Returns the current record's "longitude" value
 * @method string    getSearchString()   Returns the current record's "search_string" value
 * @method integer   getSequenceOrder()  Returns the current record's "sequence_order" value
 * @method timestamp getCreatedAt()      Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()      Returns the current record's "updated_at" value
 * @method Steps     getSteps()          Returns the current record's "Steps" value
 * @method Locations setLocationId()     Sets the current record's "location_id" value
 * @method Locations setStepId()         Sets the current record's "step_id" value
 * @method Locations setName()           Sets the current record's "name" value
 * @method Locations setStreet1()        Sets the current record's "street1" value
 * @method Locations setStreet2()        Sets the current record's "street2" value
 * @method Locations setCity()           Sets the current record's "city" value
 * @method Locations setState()          Sets the current record's "state" value
 * @method Locations setPostalCode()     Sets the current record's "postal_code" value
 * @method Locations setCountry()        Sets the current record's "country" value
 * @method Locations setLatitude()       Sets the current record's "latitude" value
 * @method Locations setLongitude()      Sets the current record's "longitude" value
 * @method Locations setSearchString()   Sets the current record's "search_string" value
 * @method Locations setSequenceOrder()  Sets the current record's "sequence_order" value
 * @method Locations setCreatedAt()      Sets the current record's "created_at" value
 * @method Locations setUpdatedAt()      Sets the current record's "updated_at" value
 * @method Locations setSteps()          Sets the current record's "Steps" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocations extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('locations');
        $this->hasColumn('location_id', 'integer', 5, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 5,
             ));
        $this->hasColumn('step_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('street1', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('street2', 'string', 255, array(
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
        $this->hasColumn('state', 'string', 2, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('postal_code', 'string', 45, array(
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
        $this->hasColumn('latitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('longitude', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('search_string', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('sequence_order', 'integer', 4, array(
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
        $this->hasOne('Steps', array(
             'local' => 'step_id',
             'foreign' => 'step_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}