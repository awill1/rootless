<?php

/**
 * Messages form base class.
 *
 * @method Messages getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'message_id'      => new sfWidgetFormInputHidden(),
      'conversation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conversations'), 'add_empty' => true)),
      'author_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'subject'         => new sfWidgetFormInputText(),
      'body'            => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'message_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('message_id')), 'empty_value' => $this->getObject()->get('message_id'), 'required' => false)),
      'conversation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Conversations'), 'required' => false)),
      'author_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'subject'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'            => new sfValidatorString(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
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
