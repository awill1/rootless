<?php

/**
 * Carpools form base class.
 *
 * @method Carpools getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCarpoolsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'carpool_id'      => new sfWidgetFormInputHidden(),
      'driver_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'vehicle_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => false)),
      'route_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'), 'add_empty' => false)),
      'seats_available' => new sfWidgetFormInputText(),
      'start_date'      => new sfWidgetFormDate(),
      'start_time'      => new sfWidgetFormTime(),
      'asking_price'    => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'carpool_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('carpool_id')), 'empty_value' => $this->getObject()->get('carpool_id'), 'required' => false)),
      'driver_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'vehicle_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'))),
      'route_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'solo_route_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes_3'))),
      'seats_available' => new sfValidatorInteger(array('required' => false)),
      'start_date'      => new sfValidatorDate(array('required' => false)),
      'start_time'      => new sfValidatorTime(array('required' => false)),
      'asking_price'    => new sfValidatorNumber(array('required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('carpools[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carpools';
  }

}
