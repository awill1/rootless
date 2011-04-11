<?php

/**
 * Vehicles form base class.
 *
 * @method Vehicles getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVehiclesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idvehicle'         => new sfWidgetFormInputHidden(),
      'seatcount'         => new sfWidgetFormInputText(),
      'gasmilage'         => new sfWidgetFormInputText(),
      'year'              => new sfWidgetFormInputText(),
      'make'              => new sfWidgetFormInputText(),
      'model'             => new sfWidgetFormInputText(),
      'color'             => new sfWidgetFormInputText(),
      'licenseplate'      => new sfWidgetFormInputText(),
      'baggagecount'      => new sfWidgetFormInputText(),
      'travelers_idusers' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'createdon'         => new sfWidgetFormDateTime(),
      'comments'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'idvehicle'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idvehicle')), 'empty_value' => $this->getObject()->get('idvehicle'), 'required' => false)),
      'seatcount'         => new sfValidatorInteger(array('required' => false)),
      'gasmilage'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'year'              => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'make'              => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'model'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'color'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'licenseplate'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'baggagecount'      => new sfValidatorInteger(array('required' => false)),
      'travelers_idusers' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'createdon'         => new sfValidatorDateTime(array('required' => false)),
      'comments'          => new sfValidatorString(array('required' => false)),
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
