<?php

/**
 * SeatStatuses form base class.
 *
 * @method SeatStatuses getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatStatusesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_status_id' => new sfWidgetFormInputHidden(),
      'display_text'   => new sfWidgetFormInputText(),
      'slug'           => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'seat_status_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_status_id')), 'empty_value' => $this->getObject()->get('seat_status_id'), 'required' => false)),
      'display_text'   => new sfValidatorString(array('max_length' => 45)),
      'slug'           => new sfValidatorString(array('max_length' => 45)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seat_statuses[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatStatuses';
  }

}
