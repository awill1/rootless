<?php

/**
 * Locations form base class.
 *
 * @method Locations getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLocationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'location_id'    => new sfWidgetFormInputHidden(),
      'step_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Steps'), 'add_empty' => false)),
      'name'           => new sfWidgetFormInputText(),
      'street1'        => new sfWidgetFormInputText(),
      'street2'        => new sfWidgetFormInputText(),
      'city'           => new sfWidgetFormInputText(),
      'state'          => new sfWidgetFormInputText(),
      'postal_code'    => new sfWidgetFormInputText(),
      'country'        => new sfWidgetFormInputText(),
      'latitude'       => new sfWidgetFormInputText(),
      'longitude'      => new sfWidgetFormInputText(),
      'search_string'  => new sfWidgetFormInputText(),
      'sequence_order' => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'location_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('location_id')), 'empty_value' => $this->getObject()->get('location_id'), 'required' => false)),
      'step_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Steps'))),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street1'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street2'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'state'          => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'postal_code'    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'country'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'latitude'       => new sfValidatorNumber(array('required' => false)),
      'longitude'      => new sfValidatorNumber(array('required' => false)),
      'search_string'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sequence_order' => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
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
