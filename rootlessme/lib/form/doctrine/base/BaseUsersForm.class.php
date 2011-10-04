<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'          => new sfWidgetFormInputHidden(),
      'person_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'email'              => new sfWidgetFormInputText(),
      'encrypted_password' => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_name'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_name')), 'empty_value' => $this->getObject()->get('user_name'), 'required' => false)),
      'person_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'email'              => new sfValidatorString(array('max_length' => 45)),
      'encrypted_password' => new sfValidatorString(array('max_length' => 128)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
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
