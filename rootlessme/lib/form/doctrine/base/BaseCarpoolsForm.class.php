<?php

/**
 * Carpools form base class.
 *
 * @method Carpools getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCarpoolsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'carpool_id'  => new sfWidgetFormInputHidden(),
      'route_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'vehicle_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => false)),
      'start_date'  => new sfWidgetFormDate(),
      'start_time'  => new sfWidgetFormTime(),
      'description' => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'carpool_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('carpool_id')), 'empty_value' => $this->getObject()->get('carpool_id'), 'required' => false)),
      'route_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'vehicle_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'))),
      'start_date'  => new sfValidatorDate(array('required' => false)),
      'start_time'  => new sfValidatorTime(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
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
