<?php

/**
 * Profiles form base class.
 *
 * @method Profiles getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfilesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idprofile'        => new sfWidgetFormInputHidden(),
      'firstname'        => new sfWidgetFormInputText(),
      'lastname'         => new sfWidgetFormInputText(),
      'pictureurl'       => new sfWidgetFormInputText(),
      'pictureurllarge'  => new sfWidgetFormInputText(),
      'pictureurlmedium' => new sfWidgetFormInputText(),
      'pictureurlsmall'  => new sfWidgetFormInputText(),
      'pictureurltiny'   => new sfWidgetFormInputText(),
      'address1'         => new sfWidgetFormInputText(),
      'address2'         => new sfWidgetFormInputText(),
      'city'             => new sfWidgetFormInputText(),
      'state'            => new sfWidgetFormInputText(),
      'postalcode'       => new sfWidgetFormInputText(),
      'country'          => new sfWidgetFormInputText(),
      'birthday'         => new sfWidgetFormDate(),
      'gender'           => new sfWidgetFormInputText(),
      'aboutme'          => new sfWidgetFormTextarea(),
      'top5'             => new sfWidgetFormTextarea(),
      'wantstotravelto'  => new sfWidgetFormTextarea(),
      'music'            => new sfWidgetFormTextarea(),
      'movies'           => new sfWidgetFormTextarea(),
      'books'            => new sfWidgetFormTextarea(),
      'interests'        => new sfWidgetFormTextarea(),
      'favoritewebsites' => new sfWidgetFormTextarea(),
      'websiteurl'       => new sfWidgetFormInputText(),
      'facebookusername' => new sfWidgetFormInputText(),
      'twitterusername'  => new sfWidgetFormInputText(),
      'createdon'        => new sfWidgetFormDateTime(),
      'modifiedon'       => new sfWidgetFormDateTime(),
      'users_username'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idprofile'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idprofile')), 'empty_value' => $this->getObject()->get('idprofile'), 'required' => false)),
      'firstname'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'lastname'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'pictureurl'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pictureurllarge'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pictureurlmedium' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pictureurlsmall'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pictureurltiny'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address1'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'state'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'postalcode'       => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'country'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'birthday'         => new sfValidatorDate(array('required' => false)),
      'gender'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'aboutme'          => new sfValidatorString(array('required' => false)),
      'top5'             => new sfValidatorString(array('required' => false)),
      'wantstotravelto'  => new sfValidatorString(array('required' => false)),
      'music'            => new sfValidatorString(array('required' => false)),
      'movies'           => new sfValidatorString(array('required' => false)),
      'books'            => new sfValidatorString(array('required' => false)),
      'interests'        => new sfValidatorString(array('required' => false)),
      'favoritewebsites' => new sfValidatorString(array('required' => false)),
      'websiteurl'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'facebookusername' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'twitterusername'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'createdon'        => new sfValidatorDateTime(array('required' => false)),
      'modifiedon'       => new sfValidatorDateTime(array('required' => false)),
      'users_username'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
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
