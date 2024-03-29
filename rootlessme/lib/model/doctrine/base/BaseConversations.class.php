<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Conversations', 'doctrine');

/**
 * BaseConversations
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $conversation_id
 * @property integer $author_id
 * @property string $subject
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * @property Doctrine_Collection $ConversationParticipants
 * @property Doctrine_Collection $Messages
 * 
 * @method integer             getConversationId()           Returns the current record's "conversation_id" value
 * @method integer             getAuthorId()                 Returns the current record's "author_id" value
 * @method string              getSubject()                  Returns the current record's "subject" value
 * @method timestamp           getCreatedAt()                Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()                Returns the current record's "updated_at" value
 * @method People              getPeople()                   Returns the current record's "People" value
 * @method Doctrine_Collection getConversationParticipants() Returns the current record's "ConversationParticipants" collection
 * @method Doctrine_Collection getMessages()                 Returns the current record's "Messages" collection
 * @method Conversations       setConversationId()           Sets the current record's "conversation_id" value
 * @method Conversations       setAuthorId()                 Sets the current record's "author_id" value
 * @method Conversations       setSubject()                  Sets the current record's "subject" value
 * @method Conversations       setCreatedAt()                Sets the current record's "created_at" value
 * @method Conversations       setUpdatedAt()                Sets the current record's "updated_at" value
 * @method Conversations       setPeople()                   Sets the current record's "People" value
 * @method Conversations       setConversationParticipants() Sets the current record's "ConversationParticipants" collection
 * @method Conversations       setMessages()                 Sets the current record's "Messages" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConversations extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('conversations');
        $this->hasColumn('conversation_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('author_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('subject', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
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
        $this->hasOne('People', array(
             'local' => 'author_id',
             'foreign' => 'person_id'));

        $this->hasMany('ConversationParticipants', array(
             'local' => 'conversation_id',
             'foreign' => 'conversation_id'));

        $this->hasMany('Messages', array(
             'local' => 'conversation_id',
             'foreign' => 'conversation_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}