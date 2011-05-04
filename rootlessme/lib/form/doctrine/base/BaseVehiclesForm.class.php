<?php

/**
 * Vehicles form base class.
 *
 * @method Vehicles getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiclesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vehicle_id'      => new sfWidgetFormInputHidden(),
      'person_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'seat_count'      => new sfWidgetFormInputText(),
      'gas_milage'      => new sfWidgetFormInputText(),
      'model_year'      => new sfWidgetFormInputText(),
      'make'            => new sfWidgetFormInputText(),
      'model'           => new sfWidgetFormInputText(),
      'color'           => new sfWidgetFormInputText(),
      'license_plate'   => new sfWidgetFormInputText(),
      'baggage_count'   => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'image_url_large' => new sfWidgetFormInputText(),
      'image_url_small' => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'vehicle_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('vehicle_id')), 'empty_value' => $this->getObject()->get('vehicle_id'), 'required' => false)),
      'person_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'seat_count'      => new sfValidatorInteger(array('required' => false)),
      'gas_milage'      => new sfValidatorNumber(array('required' => false)),
      'model_year'      => new sfValidatorInteger(array('required' => false)),
      'make'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'model'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'color'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'license_plate'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'baggage_count'   => new sfValidatorInteger(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'image_url_large' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_url_small' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('vehicles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehicles';
  }

}
