<?php

/**
 * Notifications form base class.
 *
 * @method Notifications getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotificationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'notification_id' => new sfWidgetFormInputHidden(),
      'display_text'    => new sfWidgetFormInputText(),
      'slug'            => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'notification_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('notification_id')), 'empty_value' => $this->getObject()->get('notification_id'), 'required' => false)),
      'display_text'    => new sfValidatorString(array('max_length' => 255)),
      'slug'            => new sfValidatorString(array('max_length' => 45)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('notifications[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notifications';
  }

}
