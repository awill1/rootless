<?php

/**
 * Seats form base class.
 *
 * @method Seats getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_id'             => new sfWidgetFormInputHidden(),
      'carpool_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => false)),
      'seat_negotiation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiations'), 'add_empty' => false)),
      'price'               => new sfWidgetFormInputText(),
      'seat_count'          => new sfWidgetFormInputText(),
      'pickup_date'         => new sfWidgetFormDate(),
      'pickup_time'         => new sfWidgetFormTime(),
      'description'         => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'seat_id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_id')), 'empty_value' => $this->getObject()->get('seat_id'), 'required' => false)),
      'carpool_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'))),
      'seat_negotiation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiations'))),
      'price'               => new sfValidatorNumber(array('required' => false)),
      'seat_count'          => new sfValidatorInteger(array('required' => false)),
      'pickup_date'         => new sfValidatorDate(array('required' => false)),
      'pickup_time'         => new sfValidatorTime(array('required' => false)),
      'description'         => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seats[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seats';
  }

}
