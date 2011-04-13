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
      'route_id'         => new sfWidgetFormInputHidden(),
      'copyright'        => new sfWidgetFormInputText(),
      'summary'          => new sfWidgetFormTextarea(),
      'warning'          => new sfWidgetFormTextarea(),
      'encoded_polyline' => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'route_id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('route_id')), 'empty_value' => $this->getObject()->get('route_id'), 'required' => false)),
      'copyright'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'summary'          => new sfValidatorString(array('required' => false)),
      'warning'          => new sfValidatorString(array('required' => false)),
      'encoded_polyline' => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
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
