<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Reviews', 'doctrine');

/**
 * BaseReviews
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $rating_id
 * @property integer $reviewer_id
 * @property integer $reviewee_id
 * @property integer $was_safe
 * @property integer $was_friendly
 * @property integer $was_punctual
 * @property integer $was_courteous
 * @property string $comments
 * @property integer $driver_review
 * @property integer $passenger_review
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property People $People
 * @property People $People_2
 * 
 * @method integer   getRatingId()         Returns the current record's "rating_id" value
 * @method integer   getReviewerId()       Returns the current record's "reviewer_id" value
 * @method integer   getRevieweeId()       Returns the current record's "reviewee_id" value
 * @method integer   getWasSafe()          Returns the current record's "was_safe" value
 * @method integer   getWasFriendly()      Returns the current record's "was_friendly" value
 * @method integer   getWasPunctual()      Returns the current record's "was_punctual" value
 * @method integer   getWasCourteous()     Returns the current record's "was_courteous" value
 * @method string    getComments()         Returns the current record's "comments" value
 * @method integer   getDriverReview()     Returns the current record's "driver_review" value
 * @method integer   getPassengerReview()  Returns the current record's "passenger_review" value
 * @method timestamp getCreatedAt()        Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()        Returns the current record's "updated_at" value
 * @method People    getPeople()           Returns the current record's "People" value
 * @method People    getPeople2()          Returns the current record's "People_2" value
 * @method Reviews   setRatingId()         Sets the current record's "rating_id" value
 * @method Reviews   setReviewerId()       Sets the current record's "reviewer_id" value
 * @method Reviews   setRevieweeId()       Sets the current record's "reviewee_id" value
 * @method Reviews   setWasSafe()          Sets the current record's "was_safe" value
 * @method Reviews   setWasFriendly()      Sets the current record's "was_friendly" value
 * @method Reviews   setWasPunctual()      Sets the current record's "was_punctual" value
 * @method Reviews   setWasCourteous()     Sets the current record's "was_courteous" value
 * @method Reviews   setComments()         Sets the current record's "comments" value
 * @method Reviews   setDriverReview()     Sets the current record's "driver_review" value
 * @method Reviews   setPassengerReview()  Sets the current record's "passenger_review" value
 * @method Reviews   setCreatedAt()        Sets the current record's "created_at" value
 * @method Reviews   setUpdatedAt()        Sets the current record's "updated_at" value
 * @method Reviews   setPeople()           Sets the current record's "People" value
 * @method Reviews   setPeople2()          Sets the current record's "People_2" value
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseReviews extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reviews');
        $this->hasColumn('rating_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('reviewer_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('reviewee_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('was_safe', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('was_friendly', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('was_punctual', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('was_courteous', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('comments', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('driver_review', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('passenger_review', 'integer', 1, array(
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
             'local' => 'reviewer_id',
             'foreign' => 'person_id'));

        $this->hasOne('People as People_2', array(
             'local' => 'reviewee_id',
             'foreign' => 'person_id'));
    }
}