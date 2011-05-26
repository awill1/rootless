<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SecuritySettings', 'doctrine');

/**
 * BaseSecuritySettings
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $security_settings_id
 * @property integer $person_id
 * @property integer $can_email_promotions
 * @property integer $can_email_partners
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * 
 * @method integer          getSecuritySettingsId()   Returns the current record's "security_settings_id" value
 * @method integer          getPersonId()             Returns the current record's "person_id" value
 * @method integer          getCanEmailPromotions()   Returns the current record's "can_email_promotions" value
 * @method integer          getCanEmailPartners()     Returns the current record's "can_email_partners" value
 * @method timestamp        getCreatedAt()            Returns the current record's "created_at" value
 * @method timestamp        getUpdatedAt()            Returns the current record's "updated_at" value
 * @method People           getPeople()               Returns the current record's "People" value
 * @method SecuritySettings setSecuritySettingsId()   Sets the current record's "security_settings_id" value
 * @method SecuritySettings setPersonId()             Sets the current record's "person_id" value
 * @method SecuritySettings setCanEmailPromotions()   Sets the current record's "can_email_promotions" value
 * @method SecuritySettings setCanEmailPartners()     Sets the current record's "can_email_partners" value
 * @method SecuritySettings setCreatedAt()            Sets the current record's "created_at" value
 * @method SecuritySettings setUpdatedAt()            Sets the current record's "updated_at" value
 * @method SecuritySettings setPeople()               Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseSecuritySettings extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('security_settings');
        $this->hasColumn('security_settings_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('can_email_promotions', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('can_email_partners', 'integer', 1, array(
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
        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}