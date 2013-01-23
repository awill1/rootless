<?php

/**
 * NotificationSettings form base class.
 *
 * @method NotificationSettings getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotificationSettingsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'notification_setting_id' => new sfWidgetFormInputHidden(),
      'notification_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Notifications'), 'add_empty' => false)),
      'person_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'wants_email'             => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'notification_setting_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('notification_setting_id')), 'empty_value' => $this->getObject()->get('notification_setting_id'), 'required' => false)),
      'notification_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Notifications'))),
      'person_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'wants_email'             => new sfValidatorInteger(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('notification_settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotificationSettings';
  }

}
