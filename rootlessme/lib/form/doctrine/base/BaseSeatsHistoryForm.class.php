<?php

/**
 * SeatsHistory form base class.
 *
 * @method SeatsHistory getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatsHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_history_id' => new sfWidgetFormInputHidden(),
      'seat_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seats'), 'add_empty' => true)),
      'carpool_id'      => new sfWidgetFormInputText(),
      'passenger_id'    => new sfWidgetFormInputText(),
      'seat_status_id'  => new sfWidgetFormInputText(),
      'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => true)),
      'price'           => new sfWidgetFormInputText(),
      'seat_count'      => new sfWidgetFormInputText(),
      'pickup_date'     => new sfWidgetFormDate(),
      'pickup_time'     => new sfWidgetFormTime(),
      'description'     => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'changer_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'change_action'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'seat_history_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('seat_history_id')), 'empty_value' => $this->getObject()->get('seat_history_id'), 'required' => false)),
      'seat_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seats'), 'required' => false)),
      'carpool_id'      => new sfValidatorInteger(),
      'passenger_id'    => new sfValidatorInteger(),
      'seat_status_id'  => new sfValidatorInteger(),
      'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'required' => false)),
      'price'           => new sfValidatorNumber(array('required' => false)),
      'seat_count'      => new sfValidatorInteger(array('required' => false)),
      'pickup_date'     => new sfValidatorDate(array('required' => false)),
      'pickup_time'     => new sfValidatorTime(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'changer_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'change_action'   => new sfValidatorString(array('max_length' => 16)),
    ));

    $this->widgetSchema->setNameFormat('seats_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatsHistory';
  }

}
