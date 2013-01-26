<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Legs', 'doctrine');

/**
 * BaseLegs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $leg_id
 * @property integer $route_id
 * @property integer $sequence_order
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Routes $Routes
 * @property Doctrine_Collection $Steps
 * 
 * @method integer             getLegId()          Returns the current record's "leg_id" value
 * @method integer             getRouteId()        Returns the current record's "route_id" value
 * @method integer             getSequenceOrder()  Returns the current record's "sequence_order" value
 * @method timestamp           getCreatedAt()      Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()      Returns the current record's "updated_at" value
 * @method Routes              getRoutes()         Returns the current record's "Routes" value
 * @method Doctrine_Collection getSteps()          Returns the current record's "Steps" collection
 * @method Legs                setLegId()          Sets the current record's "leg_id" value
 * @method Legs                setRouteId()        Sets the current record's "route_id" value
 * @method Legs                setSequenceOrder()  Sets the current record's "sequence_order" value
 * @method Legs                setCreatedAt()      Sets the current record's "created_at" value
 * @method Legs                setUpdatedAt()      Sets the current record's "updated_at" value
 * @method Legs                setRoutes()         Sets the current record's "Routes" value
 * @method Legs                setSteps()          Sets the current record's "Steps" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLegs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('legs');
        $this->hasColumn('leg_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('route_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasOne('Routes', array(
             'local' => 'route_id',
             'foreign' => 'route_id'));

        $this->hasMany('Steps', array(
             'local' => 'leg_id',
             'foreign' => 'leg_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}