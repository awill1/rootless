<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Events', 'doctrine');

/**
 * BaseEvents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $event_id
 * @property integer $location_id
 * @property string $name
 * @property date $date
 * @property time $time
 * @property string $picture_url_large
 * @property string $picture_url_small
 * @property string $description
 * @property string $website_url
 * @property string $certification
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Locations $Locations
 * @property Doctrine_Collection $Comments
 * @property Doctrine_Collection $TravelersAttendingEvent
 * 
 * @method integer             getEventId()                 Returns the current record's "event_id" value
 * @method integer             getLocationId()              Returns the current record's "location_id" value
 * @method string              getName()                    Returns the current record's "name" value
 * @method date                getDate()                    Returns the current record's "date" value
 * @method time                getTime()                    Returns the current record's "time" value
 * @method string              getPictureUrlLarge()         Returns the current record's "picture_url_large" value
 * @method string              getPictureUrlSmall()         Returns the current record's "picture_url_small" value
 * @method string              getDescription()             Returns the current record's "description" value
 * @method string              getWebsiteUrl()              Returns the current record's "website_url" value
 * @method string              getCertification()           Returns the current record's "certification" value
 * @method timestamp           getCreatedAt()               Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()               Returns the current record's "updated_at" value
 * @method Locations           getLocations()               Returns the current record's "Locations" value
 * @method Doctrine_Collection getComments()                Returns the current record's "Comments" collection
 * @method Doctrine_Collection getTravelersAttendingEvent() Returns the current record's "TravelersAttendingEvent" collection
 * @method Events              setEventId()                 Sets the current record's "event_id" value
 * @method Events              setLocationId()              Sets the current record's "location_id" value
 * @method Events              setName()                    Sets the current record's "name" value
 * @method Events              setDate()                    Sets the current record's "date" value
 * @method Events              setTime()                    Sets the current record's "time" value
 * @method Events              setPictureUrlLarge()         Sets the current record's "picture_url_large" value
 * @method Events              setPictureUrlSmall()         Sets the current record's "picture_url_small" value
 * @method Events              setDescription()             Sets the current record's "description" value
 * @method Events              setWebsiteUrl()              Sets the current record's "website_url" value
 * @method Events              setCertification()           Sets the current record's "certification" value
 * @method Events              setCreatedAt()               Sets the current record's "created_at" value
 * @method Events              setUpdatedAt()               Sets the current record's "updated_at" value
 * @method Events              setLocations()               Sets the current record's "Locations" value
 * @method Events              setComments()                Sets the current record's "Comments" collection
 * @method Events              setTravelersAttendingEvent() Sets the current record's "TravelersAttendingEvent" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseEvents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('events');
        $this->hasColumn('event_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('location_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('picture_url_large', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('picture_url_small', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 1024, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1024,
             ));
        $this->hasColumn('website_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('certification', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
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
        $this->hasOne('Locations', array(
             'local' => 'location_id',
             'foreign' => 'location_id'));

        $this->hasMany('Comments', array(
             'local' => 'event_id',
             'foreign' => 'event_id'));

        $this->hasMany('TravelersAttendingEvent', array(
             'local' => 'event_id',
             'foreign' => 'event_id'));
    }
}