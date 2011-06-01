<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Comments', 'doctrine');

/**
 * BaseComments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $comment_id
 * @property integer $event_id
 * @property integer $person_id
 * @property string $comment
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Events $Events
 * @property People $People
 * 
 * @method integer   getCommentId()  Returns the current record's "comment_id" value
 * @method integer   getEventId()    Returns the current record's "event_id" value
 * @method integer   getPersonId()   Returns the current record's "person_id" value
 * @method string    getComment()    Returns the current record's "comment" value
 * @method timestamp getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()  Returns the current record's "updated_at" value
 * @method Events    getEvents()     Returns the current record's "Events" value
 * @method People    getPeople()     Returns the current record's "People" value
 * @method Comments  setCommentId()  Sets the current record's "comment_id" value
 * @method Comments  setEventId()    Sets the current record's "event_id" value
 * @method Comments  setPersonId()   Sets the current record's "person_id" value
 * @method Comments  setComment()    Sets the current record's "comment" value
 * @method Comments  setCreatedAt()  Sets the current record's "created_at" value
 * @method Comments  setUpdatedAt()  Sets the current record's "updated_at" value
 * @method Comments  setEvents()     Sets the current record's "Events" value
 * @method Comments  setPeople()     Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comments');
        $this->hasColumn('comment_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('event_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
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
        $this->hasColumn('comment', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
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
        $this->hasOne('Events', array(
             'local' => 'event_id',
             'foreign' => 'event_id'));

        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}