<?php

/**
 * Profiles form base class.
 *
 * @method Profiles getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfilesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'profile_name'       => new sfWidgetFormInputHidden(),
      'person_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'first_name'         => new sfWidgetFormInputText(),
      'last_name'          => new sfWidgetFormInputText(),
      'picture_url'        => new sfWidgetFormInputText(),
      'picture_url_large'  => new sfWidgetFormInputText(),
      'picture_url_medium' => new sfWidgetFormInputText(),
      'picture_url_small'  => new sfWidgetFormInputText(),
      'picture_url_tiny'   => new sfWidgetFormInputText(),
      'address_1'          => new sfWidgetFormInputText(),
      'address_2'          => new sfWidgetFormInputText(),
      'city'               => new sfWidgetFormInputText(),
      'state'              => new sfWidgetFormInputText(),
      'postal_code'        => new sfWidgetFormInputText(),
      'country'            => new sfWidgetFormInputText(),
      'birthday'           => new sfWidgetFormDate(),
      'gender'             => new sfWidgetFormInputText(),
      'about_me'           => new sfWidgetFormTextarea(),
      'top_5'              => new sfWidgetFormTextarea(),
      'wants_to_travel_to' => new sfWidgetFormTextarea(),
      'music'              => new sfWidgetFormTextarea(),
      'movies'             => new sfWidgetFormTextarea(),
      'books'              => new sfWidgetFormTextarea(),
      'interests'          => new sfWidgetFormTextarea(),
      'favorite_websites'  => new sfWidgetFormTextarea(),
      'website_url'        => new sfWidgetFormInputText(),
      'facebook_user_name' => new sfWidgetFormInputText(),
      'twitter_user_name'  => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'profile_name'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('profile_name')), 'empty_value' => $this->getObject()->get('profile_name'), 'required' => false)),
      'person_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'first_name'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'last_name'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'picture_url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture_url_large'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture_url_medium' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture_url_small'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture_url_tiny'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_1'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_2'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'               => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'state'              => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'postal_code'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'country'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'birthday'           => new sfValidatorDate(array('required' => false)),
      'gender'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'about_me'           => new sfValidatorString(array('required' => false)),
      'top_5'              => new sfValidatorString(array('required' => false)),
      'wants_to_travel_to' => new sfValidatorString(array('required' => false)),
      'music'              => new sfValidatorString(array('required' => false)),
      'movies'             => new sfValidatorString(array('required' => false)),
      'books'              => new sfValidatorString(array('required' => false)),
      'interests'          => new sfValidatorString(array('required' => false)),
      'favorite_websites'  => new sfValidatorString(array('required' => false)),
      'website_url'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'facebook_user_name' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'twitter_user_name'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profiles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profiles';
  }

}
