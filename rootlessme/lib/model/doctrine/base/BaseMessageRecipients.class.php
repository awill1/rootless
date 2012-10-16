<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MessageRecipients', 'doctrine');

/**
 * BaseMessageRecipients
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $message_id
 * @property integer $person_id
 * @property integer $unread
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Messages $Messages
 * @property People $People
 * 
 * @method integer           getMessageId()  Returns the current record's "message_id" value
 * @method integer           getPersonId()   Returns the current record's "person_id" value
 * @method integer           getUnread()     Returns the current record's "unread" value
 * @method timestamp         getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp         getUpdatedAt()  Returns the current record's "updated_at" value
 * @method Messages          getMessages()   Returns the current record's "Messages" value
 * @method People            getPeople()     Returns the current record's "People" value
 * @method MessageRecipients setMessageId()  Sets the current record's "message_id" value
 * @method MessageRecipients setPersonId()   Sets the current record's "person_id" value
 * @method MessageRecipients setUnread()     Sets the current record's "unread" value
 * @method MessageRecipients setCreatedAt()  Sets the current record's "created_at" value
 * @method MessageRecipients setUpdatedAt()  Sets the current record's "updated_at" value
 * @method MessageRecipients setMessages()   Sets the current record's "Messages" value
 * @method MessageRecipients setPeople()     Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMessageRecipients extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('message_recipients');
        $this->hasColumn('message_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('person_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('unread', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
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
        $this->hasOne('Messages', array(
             'local' => 'message_id',
             'foreign' => 'message_id'));

        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}