<?php

/**
 * MessageRecipients form base class.
 *
 * @method MessageRecipients getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessageRecipientsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'message_id' => new sfWidgetFormInputHidden(),
      'person_id'  => new sfWidgetFormInputHidden(),
      'unread'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'message_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('message_id')), 'empty_value' => $this->getObject()->get('message_id'), 'required' => false)),
      'person_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('person_id')), 'empty_value' => $this->getObject()->get('person_id'), 'required' => false)),
      'unread'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('message_recipients[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MessageRecipients';
  }

}
