<?php

/**
 * SeatsFilledLegs form base class.
 *
 * @method SeatsFilledLegs getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatsFilledLegsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_id'    => new sfWidgetFormInputHidden(),
      'leg_id'     => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'seat_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_id')), 'empty_value' => $this->getObject()->get('seat_id'), 'required' => false)),
      'leg_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('leg_id')), 'empty_value' => $this->getObject()->get('leg_id'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
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
