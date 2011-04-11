<?php

/**
 * Locations form base class.
 *
 * @method Locations getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLocationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idlocation'   => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'street 1'     => new sfWidgetFormInputText(),
      'street 2'     => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'state'        => new sfWidgetFormInputText(),
      'postalcode'   => new sfWidgetFormInputText(),
      'country'      => new sfWidgetFormInputText(),
      'latitude'     => new sfWidgetFormInputText(),
      'longitude'    => new sfWidgetFormInputText(),
      'searchstring' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idlocation'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idlocation')), 'empty_value' => $this->getObject()->get('idlocation'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street 1'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street 2'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'state'        => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'postalcode'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'country'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'latitude'     => new sfValidatorNumber(array('required' => false)),
      'longitude'    => new sfValidatorNumber(array('required' => false)),
      'searchstring' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('locations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Locations';
  }

}
