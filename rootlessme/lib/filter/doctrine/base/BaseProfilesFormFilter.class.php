<?php

/**
 * Profiles filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfilesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'firstname'        => new sfWidgetFormFilterInput(),
      'lastname'         => new sfWidgetFormFilterInput(),
      'pictureurl'       => new sfWidgetFormFilterInput(),
      'pictureurllarge'  => new sfWidgetFormFilterInput(),
      'pictureurlmedium' => new sfWidgetFormFilterInput(),
      'pictureurlsmall'  => new sfWidgetFormFilterInput(),
      'pictureurltiny'   => new sfWidgetFormFilterInput(),
      'address1'         => new sfWidgetFormFilterInput(),
      'address2'         => new sfWidgetFormFilterInput(),
      'city'             => new sfWidgetFormFilterInput(),
      'state'            => new sfWidgetFormFilterInput(),
      'postalcode'       => new sfWidgetFormFilterInput(),
      'country'          => new sfWidgetFormFilterInput(),
      'birthday'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gender'           => new sfWidgetFormFilterInput(),
      'aboutme'          => new sfWidgetFormFilterInput(),
      'top5'             => new sfWidgetFormFilterInput(),
      'wantstotravelto'  => new sfWidgetFormFilterInput(),
      'music'            => new sfWidgetFormFilterInput(),
      'movies'           => new sfWidgetFormFilterInput(),
      'books'            => new sfWidgetFormFilterInput(),
      'interests'        => new sfWidgetFormFilterInput(),
      'favoritewebsites' => new sfWidgetFormFilterInput(),
      'websiteurl'       => new sfWidgetFormFilterInput(),
      'facebookusername' => new sfWidgetFormFilterInput(),
      'twitterusername'  => new sfWidgetFormFilterInput(),
      'createdon'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedon'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'users_username'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'firstname'        => new sfValidatorPass(array('required' => false)),
      'lastname'         => new sfValidatorPass(array('required' => false)),
      'pictureurl'       => new sfValidatorPass(array('required' => false)),
      'pictureurllarge'  => new sfValidatorPass(array('required' => false)),
      'pictureurlmedium' => new sfValidatorPass(array('required' => false)),
      'pictureurlsmall'  => new sfValidatorPass(array('required' => false)),
      'pictureurltiny'   => new sfValidatorPass(array('required' => false)),
      'address1'         => new sfValidatorPass(array('required' => false)),
      'address2'         => new sfValidatorPass(array('required' => false)),
      'city'             => new sfValidatorPass(array('required' => false)),
      'state'            => new sfValidatorPass(array('required' => false)),
      'postalcode'       => new sfValidatorPass(array('required' => false)),
      'country'          => new sfValidatorPass(array('required' => false)),
      'birthday'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'gender'           => new sfValidatorPass(array('required' => false)),
      'aboutme'          => new sfValidatorPass(array('required' => false)),
      'top5'             => new sfValidatorPass(array('required' => false)),
      'wantstotravelto'  => new sfValidatorPass(array('required' => false)),
      'music'            => new sfValidatorPass(array('required' => false)),
      'movies'           => new sfValidatorPass(array('required' => false)),
      'books'            => new sfValidatorPass(array('required' => false)),
      'interests'        => new sfValidatorPass(array('required' => false)),
      'favoritewebsites' => new sfValidatorPass(array('required' => false)),
      'websiteurl'       => new sfValidatorPass(array('required' => false)),
      'facebookusername' => new sfValidatorPass(array('required' => false)),
      'twitterusername'  => new sfValidatorPass(array('required' => false)),
      'createdon'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedon'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'users_username'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Users'), 'column' => 'username')),
    ));

    $this->widgetSchema->setNameFormat('profiles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profiles';
  }

  public function getFields()
  {
    return array(
      'idprofile'        => 'Text',
      'firstname'        => 'Text',
      'lastname'         => 'Text',
      'pictureurl'       => 'Text',
      'pictureurllarge'  => 'Text',
      'pictureurlmedium' => 'Text',
      'pictureurlsmall'  => 'Text',
      'pictureurltiny'   => 'Text',
      'address1'         => 'Text',
      'address2'         => 'Text',
      'city'             => 'Text',
      'state'            => 'Text',
      'postalcode'       => 'Text',
      'country'          => 'Text',
      'birthday'         => 'Date',
      'gender'           => 'Text',
      'aboutme'          => 'Text',
      'top5'             => 'Text',
      'wantstotravelto'  => 'Text',
      'music'            => 'Text',
      'movies'           => 'Text',
      'books'            => 'Text',
      'interests'        => 'Text',
      'favoritewebsites' => 'Text',
      'websiteurl'       => 'Text',
      'facebookusername' => 'Text',
      'twitterusername'  => 'Text',
      'createdon'        => 'Date',
      'modifiedon'       => 'Date',
      'users_username'   => 'ForeignKey',
    );
  }
}
