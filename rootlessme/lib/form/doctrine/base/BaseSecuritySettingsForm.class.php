<?php

/**
 * SecuritySettings form base class.
 *
 * @method SecuritySettings getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSecuritySettingsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'security_settings_id' => new sfWidgetFormInputHidden(),
      'person_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'can_email_promotions' => new sfWidgetFormInputText(),
      'can_email_partners'   => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'security_settings_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('security_settings_id')), 'empty_value' => $this->getObject()->get('security_settings_id'), 'required' => false)),
      'person_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'can_email_promotions' => new sfValidatorInteger(array('required' => false)),
      'can_email_partners'   => new sfValidatorInteger(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('security_settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SecuritySettings';
  }

}
