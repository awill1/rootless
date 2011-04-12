<?php

/**
 * SeatNegotiations form base class.
 *
 * @method SeatNegotiations getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatNegotiationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_negotiation_id'          => new sfWidgetFormInputHidden(),
      'proposed_route_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'seat_negotiation_statuses_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiationStatuses'), 'add_empty' => false)),
      'carpool_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => false)),
      'passenger_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'add_empty' => false)),
      'price'                        => new sfWidgetFormInputText(),
      'seat_count'                   => new sfWidgetFormInputText(),
      'pickup_date'                  => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
      'pickup_time'                  => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'seat_negotiation_id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_negotiation_id')), 'empty_value' => $this->getObject()->get('seat_negotiation_id'), 'required' => false)),
      'proposed_route_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'seat_negotiation_statuses_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiationStatuses'))),
      'carpool_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'))),
      'passenger_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'))),
      'price'                        => new sfValidatorNumber(array('required' => false)),
      'seat_count'                   => new sfValidatorInteger(array('required' => false)),
      'pickup_date'                  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'                   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                   => new sfValidatorDateTime(array('required' => false)),
      'pickup_time'                  => new sfValidatorTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seat_negotiations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatNegotiations';
  }

}
