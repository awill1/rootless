<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Users', 'doctrine');

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $user_name
 * @property integer $person_id
 * @property string $email
 * @property string $encrypted_password
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * 
 * @method string    getUserName()           Returns the current record's "user_name" value
 * @method integer   getPersonId()           Returns the current record's "person_id" value
 * @method string    getEmail()              Returns the current record's "email" value
 * @method string    getEncryptedPassword()  Returns the current record's "encrypted_password" value
 * @method timestamp getCreatedAt()          Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()          Returns the current record's "updated_at" value
 * @method People    getPeople()             Returns the current record's "People" value
 * @method Users     setUserName()           Sets the current record's "user_name" value
 * @method Users     setPersonId()           Sets the current record's "person_id" value
 * @method Users     setEmail()              Sets the current record's "email" value
 * @method Users     setEncryptedPassword()  Sets the current record's "encrypted_password" value
 * @method Users     setCreatedAt()          Sets the current record's "created_at" value
 * @method Users     setUpdatedAt()          Sets the current record's "updated_at" value
 * @method Users     setPeople()             Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('user_name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
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
        $this->hasColumn('email', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('encrypted_password', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 128,
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
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}