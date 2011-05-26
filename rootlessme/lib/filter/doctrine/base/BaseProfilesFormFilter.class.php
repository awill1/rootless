<?php

/**
 * Profiles filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfilesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'person_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'first_name'         => new sfWidgetFormFilterInput(),
      'last_name'          => new sfWidgetFormFilterInput(),
      'picture_url'        => new sfWidgetFormFilterInput(),
      'picture_url_large'  => new sfWidgetFormFilterInput(),
      'picture_url_medium' => new sfWidgetFormFilterInput(),
      'picture_url_small'  => new sfWidgetFormFilterInput(),
      'picture_url_tiny'   => new sfWidgetFormFilterInput(),
      'address1'           => new sfWidgetFormFilterInput(),
      'address2'           => new sfWidgetFormFilterInput(),
      'city'               => new sfWidgetFormFilterInput(),
      'state'              => new sfWidgetFormFilterInput(),
      'postal_code'        => new sfWidgetFormFilterInput(),
      'country'            => new sfWidgetFormFilterInput(),
      'birthday'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gender'             => new sfWidgetFormFilterInput(),
      'about_me'           => new sfWidgetFormFilterInput(),
      'top5'               => new sfWidgetFormFilterInput(),
      'wants_to_travel_to' => new sfWidgetFormFilterInput(),
      'music'              => new sfWidgetFormFilterInput(),
      'movies'             => new sfWidgetFormFilterInput(),
      'books'              => new sfWidgetFormFilterInput(),
      'interests'          => new sfWidgetFormFilterInput(),
      'favorite_websites'  => new sfWidgetFormFilterInput(),
      'website_url'        => new sfWidgetFormFilterInput(),
      'facebook_user_name' => new sfWidgetFormFilterInput(),
      'twitter_user_name'  => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'person_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'first_name'         => new sfValidatorPass(array('required' => false)),
      'last_name'          => new sfValidatorPass(array('required' => false)),
      'picture_url'        => new sfValidatorPass(array('required' => false)),
      'picture_url_large'  => new sfValidatorPass(array('required' => false)),
      'picture_url_medium' => new sfValidatorPass(array('required' => false)),
      'picture_url_small'  => new sfValidatorPass(array('required' => false)),
      'picture_url_tiny'   => new sfValidatorPass(array('required' => false)),
      'address1'           => new sfValidatorPass(array('required' => false)),
      'address2'           => new sfValidatorPass(array('required' => false)),
      'city'               => new sfValidatorPass(array('required' => false)),
      'state'              => new sfValidatorPass(array('required' => false)),
      'postal_code'        => new sfValidatorPass(array('required' => false)),
      'country'            => new sfValidatorPass(array('required' => false)),
      'birthday'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'gender'             => new sfValidatorPass(array('required' => false)),
      'about_me'           => new sfValidatorPass(array('required' => false)),
      'top5'               => new sfValidatorPass(array('required' => false)),
      'wants_to_travel_to' => new sfValidatorPass(array('required' => false)),
      'music'              => new sfValidatorPass(array('required' => false)),
      'movies'             => new sfValidatorPass(array('required' => false)),
      'books'              => new sfValidatorPass(array('required' => false)),
      'interests'          => new sfValidatorPass(array('required' => false)),
      'favorite_websites'  => new sfValidatorPass(array('required' => false)),
      'website_url'        => new sfValidatorPass(array('required' => false)),
      'facebook_user_name' => new sfValidatorPass(array('required' => false)),
      'twitter_user_name'  => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
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
      'profile_name'       => 'Text',
      'person_id'          => 'ForeignKey',
      'first_name'         => 'Text',
      'last_name'          => 'Text',
      'picture_url'        => 'Text',
      'picture_url_large'  => 'Text',
      'picture_url_medium' => 'Text',
      'picture_url_small'  => 'Text',
      'picture_url_tiny'   => 'Text',
      'address1'           => 'Text',
      'address2'           => 'Text',
      'city'               => 'Text',
      'state'              => 'Text',
      'postal_code'        => 'Text',
      'country'            => 'Text',
      'birthday'           => 'Date',
      'gender'             => 'Text',
      'about_me'           => 'Text',
      'top5'               => 'Text',
      'wants_to_travel_to' => 'Text',
      'music'              => 'Text',
      'movies'             => 'Text',
      'books'              => 'Text',
      'interests'          => 'Text',
      'favorite_websites'  => 'Text',
      'website_url'        => 'Text',
      'facebook_user_name' => 'Text',
      'twitter_user_name'  => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
