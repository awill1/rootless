<?php

/**
 * Passengers form base class.
 *
 * @method Passengers getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePassengersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'passenger_id'    => new sfWidgetFormInputHidden(),
      'person_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'passenger_count' => new sfWidgetFormInputText(),
      'start_date'      => new sfWidgetFormDate(),
      'start_time'      => new sfWidgetFormTime(),
      'asking_price'    => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'isPublic'        => new sfWidgetFormInputText(),
      'status_id'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'passenger_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('passenger_id')), 'empty_value' => $this->getObject()->get('passenger_id'), 'required' => false)),
      'person_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'passenger_count' => new sfValidatorInteger(array('required' => false)),
      'start_date'      => new sfValidatorDate(array('required' => false)),
      'start_time'      => new sfValidatorTime(array('required' => false)),
      'asking_price'    => new sfValidatorNumber(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'isPublic'        => new sfValidatorInteger(array('required' => false)),
      'status_id'       => new sfValidatorInteger(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('passengers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Passengers';
  }

}
