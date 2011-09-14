<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SeatsFilledLegs', 'doctrine');

/**
 * BaseSeatsFilledLegs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $seat_id
 * @property integer $leg_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Seats $Seats
 * @property Legs $Legs
 * 
 * @method integer         getSeatId()     Returns the current record's "seat_id" value
 * @method integer         getLegId()      Returns the current record's "leg_id" value
 * @method timestamp       getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp       getUpdatedAt()  Returns the current record's "updated_at" value
 * @method Seats           getSeats()      Returns the current record's "Seats" value
 * @method Legs            getLegs()       Returns the current record's "Legs" value
 * @method SeatsFilledLegs setSeatId()     Sets the current record's "seat_id" value
 * @method SeatsFilledLegs setLegId()      Sets the current record's "leg_id" value
 * @method SeatsFilledLegs setCreatedAt()  Sets the current record's "created_at" value
 * @method SeatsFilledLegs setUpdatedAt()  Sets the current record's "updated_at" value
 * @method SeatsFilledLegs setSeats()      Sets the current record's "Seats" value
 * @method SeatsFilledLegs setLegs()       Sets the current record's "Legs" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSeatsFilledLegs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('seats_filled_legs');
        $this->hasColumn('seat_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('leg_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
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
        $this->hasOne('Seats', array(
             'local' => 'seat_id',
             'foreign' => 'seat_id'));

        $this->hasOne('Legs', array(
             'local' => 'leg_id',
             'foreign' => 'leg_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}