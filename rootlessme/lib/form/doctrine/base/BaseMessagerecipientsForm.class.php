<?php

/**
 * Messagerecipients form base class.
 *
 * @method Messagerecipients getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessagerecipientsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'messages_idmessages'  => new sfWidgetFormInputHidden(),
      'travelers_idtraveler' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'messages_idmessages'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('messages_idmessages')), 'empty_value' => $this->getObject()->get('messages_idmessages'), 'required' => false)),
      'travelers_idtraveler' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('travelers_idtraveler')), 'empty_value' => $this->getObject()->get('travelers_idtraveler'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('messagerecipients[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Messagerecipients';
  }

}
