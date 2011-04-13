<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Steps', 'doctrine');

/**
 * BaseSteps
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $step_id
 * @property integer $leg_id
 * @property string $instructions
 * @property integer $distance
 * @property integer $duration
 * @property string $encoded_polyline
 * @property integer $sequence_order
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Legs $Legs
 * @property Doctrine_Collection $Locations
 * 
 * @method integer             getStepId()           Returns the current record's "step_id" value
 * @method integer             getLegId()            Returns the current record's "leg_id" value
 * @method string              getInstructions()     Returns the current record's "instructions" value
 * @method integer             getDistance()         Returns the current record's "distance" value
 * @method integer             getDuration()         Returns the current record's "duration" value
 * @method string              getEncodedPolyline()  Returns the current record's "encoded_polyline" value
 * @method integer             getSequenceOrder()    Returns the current record's "sequence_order" value
 * @method timestamp           getCreatedAt()        Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()        Returns the current record's "updated_at" value
 * @method Legs                getLegs()             Returns the current record's "Legs" value
 * @method Doctrine_Collection getLocations()        Returns the current record's "Locations" collection
 * @method Steps               setStepId()           Sets the current record's "step_id" value
 * @method Steps               setLegId()            Sets the current record's "leg_id" value
 * @method Steps               setInstructions()     Sets the current record's "instructions" value
 * @method Steps               setDistance()         Sets the current record's "distance" value
 * @method Steps               setDuration()         Sets the current record's "duration" value
 * @method Steps               setEncodedPolyline()  Sets the current record's "encoded_polyline" value
 * @method Steps               setSequenceOrder()    Sets the current record's "sequence_order" value
 * @method Steps               setCreatedAt()        Sets the current record's "created_at" value
 * @method Steps               setUpdatedAt()        Sets the current record's "updated_at" value
 * @method Steps               setLegs()             Sets the current record's "Legs" value
 * @method Steps               setLocations()        Sets the current record's "Locations" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseSteps extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('steps');
        $this->hasColumn('step_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('leg_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('instructions', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
        $this->hasColumn('encoded_polyline', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
        $this->hasOne('Legs', array(
             'local' => 'leg_id',
             'foreign' => 'leg_id'));

        $this->hasMany('Locations', array(
             'local' => 'step_id',
             'foreign' => 'step_id'));
    }
}