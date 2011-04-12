<?php

/**
 * SeatsFilledLegs form base class.
 *
 * @method SeatsFilledLegs getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatsFilledLegsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seats_seat_id' => new sfWidgetFormInputHidden(),
      'legs_leg_id'   => new sfWidgetFormInputHidden(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'seats_seat_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seats_seat_id')), 'empty_value' => $this->getObject()->get('seats_seat_id'), 'required' => false)),
      'legs_leg_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('legs_leg_id')), 'empty_value' => $this->getObject()->get('legs_leg_id'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seats_filled_legs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatsFilledLegs';
  }

}
