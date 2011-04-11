<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Negotiation', 'doctrine');

/**
 * BaseNegotiation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idnegotiation
 * @property float $price
 * @property integer $numberofseats
 * @property date $date
 * @property time $time
 * @property string $comments
 * @property integer $idseatrequest
 * @property integer $idnegotiationtype
 * @property integer $pickuplocation
 * @property integer $dropofflocation
 * @property Seatrequests $Seatrequests
 * @property Negotiationtypes $Negotiationtypes
 * @property Locations $Locations
 * @property Locations $Locations_4
 * 
 * @method integer          getIdnegotiation()     Returns the current record's "idnegotiation" value
 * @method float            getPrice()             Returns the current record's "price" value
 * @method integer          getNumberofseats()     Returns the current record's "numberofseats" value
 * @method date             getDate()              Returns the current record's "date" value
 * @method time             getTime()              Returns the current record's "time" value
 * @method string           getComments()          Returns the current record's "comments" value
 * @method integer          getIdseatrequest()     Returns the current record's "idseatrequest" value
 * @method integer          getIdnegotiationtype() Returns the current record's "idnegotiationtype" value
 * @method integer          getPickuplocation()    Returns the current record's "pickuplocation" value
 * @method integer          getDropofflocation()   Returns the current record's "dropofflocation" value
 * @method Seatrequests     getSeatrequests()      Returns the current record's "Seatrequests" value
 * @method Negotiationtypes getNegotiationtypes()  Returns the current record's "Negotiationtypes" value
 * @method Locations        getLocations()         Returns the current record's "Locations" value
 * @method Locations        getLocations4()        Returns the current record's "Locations_4" value
 * @method Negotiation      setIdnegotiation()     Sets the current record's "idnegotiation" value
 * @method Negotiation      setPrice()             Sets the current record's "price" value
 * @method Negotiation      setNumberofseats()     Sets the current record's "numberofseats" value
 * @method Negotiation      setDate()              Sets the current record's "date" value
 * @method Negotiation      setTime()              Sets the current record's "time" value
 * @method Negotiation      setComments()          Sets the current record's "comments" value
 * @method Negotiation      setIdseatrequest()     Sets the current record's "idseatrequest" value
 * @method Negotiation      setIdnegotiationtype() Sets the current record's "idnegotiationtype" value
 * @method Negotiation      setPickuplocation()    Sets the current record's "pickuplocation" value
 * @method Negotiation      setDropofflocation()   Sets the current record's "dropofflocation" value
 * @method Negotiation      setSeatrequests()      Sets the current record's "Seatrequests" value
 * @method Negotiation      setNegotiationtypes()  Sets the current record's "Negotiationtypes" value
 * @method Negotiation      setLocations()         Sets the current record's "Locations" value
 * @method Negotiation      setLocations4()        Sets the current record's "Locations_4" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseNegotiation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('negotiation');
        $this->hasColumn('idnegotiation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('price', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('numberofseats', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('comments', 'string', 1024, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1024,
             ));
        $this->hasColumn('idseatrequest', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('idnegotiationtype', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('pickuplocation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('dropofflocation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Seatrequests', array(
             'local' => 'idseatrequest',
             'foreign' => 'idseatrequest'));

        $this->hasOne('Negotiationtypes', array(
             'local' => 'idnegotiationtype',
             'foreign' => 'idnegotiationtype'));

        $this->hasOne('Locations', array(
             'local' => 'pickuplocation',
             'foreign' => 'idlocation'));

        $this->hasOne('Locations as Locations_4', array(
             'local' => 'dropofflocation',
             'foreign' => 'idlocation'));
    }
}