<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Messages', 'doctrine');

/**
 * BaseMessages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_message
 * @property integer $conversation_id
 * @property integer $author_id
 * @property string $body
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Conversations $Conversations
 * @property People $People
 * 
 * @method integer       getIdMessage()       Returns the current record's "id_message" value
 * @method integer       getConversationId()  Returns the current record's "conversation_id" value
 * @method integer       getAuthorId()        Returns the current record's "author_id" value
 * @method string        getBody()            Returns the current record's "body" value
 * @method timestamp     getCreatedAt()       Returns the current record's "created_at" value
 * @method timestamp     getUpdatedAt()       Returns the current record's "updated_at" value
 * @method Conversations getConversations()   Returns the current record's "Conversations" value
 * @method People        getPeople()          Returns the current record's "People" value
 * @method Messages      setIdMessage()       Sets the current record's "id_message" value
 * @method Messages      setConversationId()  Sets the current record's "conversation_id" value
 * @method Messages      setAuthorId()        Sets the current record's "author_id" value
 * @method Messages      setBody()            Sets the current record's "body" value
 * @method Messages      setCreatedAt()       Sets the current record's "created_at" value
 * @method Messages      setUpdatedAt()       Sets the current record's "updated_at" value
 * @method Messages      setConversations()   Sets the current record's "Conversations" value
 * @method Messages      setPeople()          Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseMessages extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('messages');
        $this->hasColumn('id_message', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('conversation_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
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
        $this->hasColumn('body', 'string', null, array(
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
        $this->hasOne('Conversations', array(
             'local' => 'conversation_id',
             'foreign' => 'conversation_id'));

        $this->hasOne('People', array(
             'local' => 'author_id',
             'foreign' => 'person_id'));
    }
}