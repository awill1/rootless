<?php

/**
 * Waypoints form base class.
 *
 * @method Waypoints getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWaypointsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'rideofferposts_idrideofferpost' => new sfWidgetFormInputHidden(),
      'locations_idlocation'           => new sfWidgetFormInputHidden(),
      'sequence'                       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'rideofferposts_idrideofferpost' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('rideofferposts_idrideofferpost')), 'empty_value' => $this->getObject()->get('rideofferposts_idrideofferpost'), 'required' => false)),
      'locations_idlocation'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('locations_idlocation')), 'empty_value' => $this->getObject()->get('locations_idlocation'), 'required' => false)),
      'sequence'                       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('waypoints[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Waypoints';
  }

}
