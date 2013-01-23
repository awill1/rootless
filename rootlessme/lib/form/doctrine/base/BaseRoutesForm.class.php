<?php

/**
 * Routes form base class.
 *
 * @method Routes getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRoutesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'route_id'              => new sfWidgetFormInputHidden(),
      'copyright'             => new sfWidgetFormInputText(),
      'summary'               => new sfWidgetFormTextarea(),
      'warning'               => new sfWidgetFormTextarea(),
      'encoded_polyline'      => new sfWidgetFormTextarea(),
      'origin_address'        => new sfWidgetFormInputText(),
      'origin_city'           => new sfWidgetFormInputText(),
      'origin_state'          => new sfWidgetFormInputText(),
      'origin_latitude'       => new sfWidgetFormInputText(),
      'origin_longitude'      => new sfWidgetFormInputText(),
      'origin_place_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Origin_Places'), 'add_empty' => true)),
      'destination_address'   => new sfWidgetFormInputText(),
      'destination_city'      => new sfWidgetFormInputText(),
      'destination_state'     => new sfWidgetFormInputText(),
      'destination_latitude'  => new sfWidgetFormInputText(),
      'destination_longitude' => new sfWidgetFormInputText(),
      'destination_place_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destination_Places'), 'add_empty' => true)),
      'distance'              => new sfWidgetFormInputText(),
      'duration'              => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'route_id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('route_id')), 'empty_value' => $this->getObject()->get('route_id'), 'required' => false)),
      'copyright'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'summary'               => new sfValidatorString(array('required' => false)),
      'warning'               => new sfValidatorString(array('required' => false)),
      'encoded_polyline'      => new sfValidatorString(array('required' => false)),
      'origin_address'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'origin_city'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'origin_state'          => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'origin_latitude'       => new sfValidatorNumber(array('required' => false)),
      'origin_longitude'      => new sfValidatorNumber(array('required' => false)),
      'origin_place_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Origin_Places'), 'required' => false)),
      'destination_address'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'destination_city'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'destination_state'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'destination_latitude'  => new sfValidatorNumber(array('required' => false)),
      'destination_longitude' => new sfValidatorNumber(array('required' => false)),
      'destination_place_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destination_Places'), 'required' => false)),
      'distance'              => new sfValidatorInteger(array('required' => false)),
      'duration'              => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('routes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Routes';
  }

}
