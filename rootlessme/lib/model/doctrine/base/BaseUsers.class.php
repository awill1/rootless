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
 * @property People $People
 * 
 * @method string  getUserName()           Returns the current record's "user_name" value
 * @method integer getPersonId()           Returns the current record's "person_id" value
 * @method string  getEmail()              Returns the current record's "email" value
 * @method string  getEncryptedPassword()  Returns the current record's "encrypted_password" value
 * @method People  getPeople()             Returns the current record's "People" value
 * @method Users   setUserName()           Sets the current record's "user_name" value
 * @method Users   setPersonId()           Sets the current record's "person_id" value
 * @method Users   setEmail()              Sets the current record's "email" value
 * @method Users   setEncryptedPassword()  Sets the current record's "encrypted_password" value
 * @method Users   setPeople()             Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));
    }
}