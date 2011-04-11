<?php

/**
 * Rideofferposts form base class.
 *
 * @method Rideofferposts getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRideofferpostsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idrideofferpost'    => new sfWidgetFormInputHidden(),
      'travelers_idusers'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'price'              => new sfWidgetFormInputText(),
      'numberofseats'      => new sfWidgetFormInputText(),
      'date'               => new sfWidgetFormDate(),
      'time'               => new sfWidgetFormTime(),
      'comments'           => new sfWidgetFormTextarea(),
      'origin'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => false)),
      'destination'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'), 'add_empty' => false)),
      'vehicles_idvehicle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idrideofferpost'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idrideofferpost')), 'empty_value' => $this->getObject()->get('idrideofferpost'), 'required' => false)),
      'travelers_idusers'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'price'              => new sfValidatorNumber(array('required' => false)),
      'numberofseats'      => new sfValidatorInteger(array('required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'time'               => new sfValidatorTime(array('required' => false)),
      'comments'           => new sfValidatorString(array('required' => false)),
      'origin'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'))),
      'destination'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'))),
      'vehicles_idvehicle' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rideofferposts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rideofferposts';
  }

}
