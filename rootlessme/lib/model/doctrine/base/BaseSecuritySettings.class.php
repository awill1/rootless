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
 * @property People $People
 * 
 * @method integer          getSecuritySettingsId()   Returns the current record's "security_settings_id" value
 * @method integer          getPersonId()             Returns the current record's "person_id" value
 * @method integer          getCanEmailPromotions()   Returns the current record's "can_email_promotions" value
 * @method integer          getCanEmailPartners()     Returns the current record's "can_email_partners" value
 * @method People           getPeople()               Returns the current record's "People" value
 * @method SecuritySettings setSecuritySettingsId()   Sets the current record's "security_settings_id" value
 * @method SecuritySettings setPersonId()             Sets the current record's "person_id" value
 * @method SecuritySettings setCanEmailPromotions()   Sets the current record's "can_email_promotions" value
 * @method SecuritySettings setCanEmailPartners()     Sets the current record's "can_email_partners" value
 * @method SecuritySettings setPeople()               Sets the current record's "People" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('People', array(
             'local' => 'person_id',
             'foreign' => 'person_id'));
    }
}