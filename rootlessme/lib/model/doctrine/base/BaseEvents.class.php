<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Events', 'doctrine');

/**
 * BaseEvents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $event_id
 * @property integer $place_id
 * @property string $name
 * @property string $subheading
 * @property date $start_date
 * @property date $end_date
 * @property string $website_url
 * @property integer $isPartner
 * @property string $contact_email_address
 * @property string $contact_phone_number
 * @property string $index_image_url
 * @property string $tags
 * @property string $css_style
 * @property integer $is_deleted
 * @property string $slug
 * @property string $share_image_url
 * @property Places $Places
 * @property Doctrine_Collection $Origin_Route
 * @property Doctrine_Collection $Destination_Route
 * 
 * @method integer             getEventId()               Returns the current record's "event_id" value
 * @method integer             getPlaceId()               Returns the current record's "place_id" value
 * @method string              getName()                  Returns the current record's "name" value
 * @method string              getSubheading()            Returns the current record's "subheading" value
 * @method date                getStartDate()             Returns the current record's "start_date" value
 * @method date                getEndDate()               Returns the current record's "end_date" value
 * @method string              getWebsiteUrl()            Returns the current record's "website_url" value
 * @method integer             getIsPartner()             Returns the current record's "isPartner" value
 * @method string              getContactEmailAddress()   Returns the current record's "contact_email_address" value
 * @method string              getContactPhoneNumber()    Returns the current record's "contact_phone_number" value
 * @method string              getIndexImageUrl()         Returns the current record's "index_image_url" value
 * @method string              getTags()                  Returns the current record's "tags" value
 * @method string              getCssStyle()              Returns the current record's "css_style" value
 * @method integer             getIsDeleted()             Returns the current record's "is_deleted" value
 * @method string              getSlug()                  Returns the current record's "slug" value
 * @method string              getShareImageUrl()         Returns the current record's "share_image_url" value
 * @method Places              getPlaces()                Returns the current record's "Places" value
 * @method Doctrine_Collection getOriginRoute()           Returns the current record's "Origin_Route" collection
 * @method Doctrine_Collection getDestinationRoute()      Returns the current record's "Destination_Route" collection
 * @method Events              setEventId()               Sets the current record's "event_id" value
 * @method Events              setPlaceId()               Sets the current record's "place_id" value
 * @method Events              setName()                  Sets the current record's "name" value
 * @method Events              setSubheading()            Sets the current record's "subheading" value
 * @method Events              setStartDate()             Sets the current record's "start_date" value
 * @method Events              setEndDate()               Sets the current record's "end_date" value
 * @method Events              setWebsiteUrl()            Sets the current record's "website_url" value
 * @method Events              setIsPartner()             Sets the current record's "isPartner" value
 * @method Events              setContactEmailAddress()   Sets the current record's "contact_email_address" value
 * @method Events              setContactPhoneNumber()    Sets the current record's "contact_phone_number" value
 * @method Events              setIndexImageUrl()         Sets the current record's "index_image_url" value
 * @method Events              setTags()                  Sets the current record's "tags" value
 * @method Events              setCssStyle()              Sets the current record's "css_style" value
 * @method Events              setIsDeleted()             Sets the current record's "is_deleted" value
 * @method Events              setSlug()                  Sets the current record's "slug" value
 * @method Events              setShareImageUrl()         Sets the current record's "share_image_url" value
 * @method Events              setPlaces()                Sets the current record's "Places" value
 * @method Events              setOriginRoute()           Sets the current record's "Origin_Route" collection
 * @method Events              setDestinationRoute()      Sets the current record's "Destination_Route" collection
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
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
        $this->hasColumn('place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'notnull' => false,
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
        $this->hasColumn('subheading', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('start_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('end_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
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
        $this->hasColumn('isPartner', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('contact_email_address', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('contact_phone_number', 'string', 32, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 32,
             ));
        $this->hasColumn('index_image_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('tags', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('css_style', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('is_deleted', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('slug', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'unique' => true,
             'length' => 128,
             ));
        $this->hasColumn('share_image_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Places', array(
             'local' => 'place_id',
             'foreign' => 'place_id'));

        $this->hasMany('Routes as Origin_Route', array(
             'local' => 'event_id',
             'foreign' => 'origin_event_id'));

        $this->hasMany('Routes as Destination_Route', array(
             'local' => 'event_id',
             'foreign' => 'destination_event_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}