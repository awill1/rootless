<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('NotificationSettings', 'doctrine');

/**
 * BaseNotificationSettings
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $notification_setting_id
 * @property integer $notification_id
 * @property integer $person_id
 * @property integer $wants_email
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Notifications $Notifications
 * @property People $People
 * 
 * @method integer              getNotificationSettingId()   Returns the current record's "notification_setting_id" value
 * @method integer              getNotificationId()          Returns the current record's "notification_id" value
 * @method integer              getPersonId()                Returns the current record's "person_id" value
 * @method integer              getWantsEmail()              Returns the current record's "wants_email" value
 * @method timestamp            getCreatedAt()               Returns the current record's "created_at" value
 * @method timestamp            getUpdatedAt()               Returns the current record's "updated_at" value
 * @method Notifications        getNotifications()           Returns the current record's "Notifications" value
 * @method People               getPeople()                  Returns the current record's "People" value
 * @method NotificationSettings setNotificationSettingId()   Sets the current record's "notification_setting_id" value
 * @method NotificationSettings setNotificationId()          Sets the current record's "notification_id" value
 * @method NotificationSettings setPersonId()                Sets the current record's "person_id" value
 * @method NotificationSettings setWantsEmail()              Sets the current record's "wants_email" value
 * @method NotificationSettings setCreatedAt()               Sets the current record's "created_at" value
 * @method NotificationSettings setUpdatedAt()               Sets the current record's "updated_at" value
 * @method NotificationSettings setNotifications()           Sets the current record's "Notifications" value
 * @method NotificationSettings setPeople()                  Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNotificationSettings extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('notification_settings');
        $this->hasColumn('notification_setting_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('notification_id', 'integer', 4, array(
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
        $this->hasColumn('wants_email', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasOne('Notifications', array(
             'local' => 'notification_id',
             'foreign' => 'notification_id'));

        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}