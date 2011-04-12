<?php

/**
 * Drivers form base class.
 *
 * @method Drivers getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDriversForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'driver_id'       => new sfWidgetFormInputHidden(),
      'person_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'carpool_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => false)),
      'seats_available' => new sfWidgetFormInputText(),
      'start_date'      => new sfWidgetFormDate(),
      'start_time'      => new sfWidgetFormTime(),
      'asking_price'    => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'driver_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('driver_id')), 'empty_value' => $this->getObject()->get('driver_id'), 'required' => false)),
      'person_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'carpool_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'))),
      'seats_available' => new sfValidatorInteger(array('required' => false)),
      'start_date'      => new sfValidatorDate(),
      'start_time'      => new sfValidatorTime(array('required' => false)),
      'asking_price'    => new sfValidatorNumber(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('drivers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Drivers';
  }

}
