<?php

/**
 * SeatNegotiationMessage form base class.
 *
 * @method SeatNegotiationMessage getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatNegotiationMessageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_negotiation_message_id' => new sfWidgetFormInputHidden(),
      'seat_negotiation_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiations'), 'add_empty' => false)),
      'author_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'message'                     => new sfWidgetFormTextarea(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'seat_negotiation_message_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_negotiation_message_id')), 'empty_value' => $this->getObject()->get('seat_negotiation_message_id'), 'required' => false)),
      'seat_negotiation_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiations'))),
      'author_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'message'                     => new sfValidatorString(array('required' => false)),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seat_negotiation_message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatNegotiationMessage';
  }

}
