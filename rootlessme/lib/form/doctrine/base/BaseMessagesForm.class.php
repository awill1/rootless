<?php

/**
 * Messages form base class.
 *
 * @method Messages getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmessages'       => new sfWidgetFormInputHidden(),
      'subject'          => new sfWidgetFormInputText(),
      'body'             => new sfWidgetFormTextarea(),
      'sender'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'createdon'        => new sfWidgetFormDateTime(),
      'repliedtomessage' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idmessages'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idmessages')), 'empty_value' => $this->getObject()->get('idmessages'), 'required' => false)),
      'subject'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'             => new sfValidatorString(array('required' => false)),
      'sender'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'createdon'        => new sfValidatorDateTime(array('required' => false)),
      'repliedtomessage' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('messages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Messages';
  }

}
