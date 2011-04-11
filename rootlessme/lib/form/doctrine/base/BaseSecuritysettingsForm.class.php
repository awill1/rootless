<?php

/**
 * Securitysettings form base class.
 *
 * @method Securitysettings getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSecuritysettingsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idsecuritysettings' => new sfWidgetFormInputHidden(),
      'canemailpromotions' => new sfWidgetFormInputText(),
      'canemailpartners'   => new sfWidgetFormInputText(),
      'users_username'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idsecuritysettings' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idsecuritysettings')), 'empty_value' => $this->getObject()->get('idsecuritysettings'), 'required' => false)),
      'canemailpromotions' => new sfValidatorInteger(array('required' => false)),
      'canemailpartners'   => new sfValidatorInteger(array('required' => false)),
      'users_username'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
    ));

    $this->widgetSchema->setNameFormat('securitysettings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Securitysettings';
  }

}
