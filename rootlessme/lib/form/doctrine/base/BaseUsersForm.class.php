<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'          => new sfWidgetFormInputHidden(),
      'email'             => new sfWidgetFormInputText(),
      'encryptedpassword' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'username'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('username')), 'empty_value' => $this->getObject()->get('username'), 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 45)),
      'encryptedpassword' => new sfValidatorString(array('max_length' => 128)),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
