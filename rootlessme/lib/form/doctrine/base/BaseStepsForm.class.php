<?php

/**
 * Steps form base class.
 *
 * @method Steps getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStepsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'step_id'          => new sfWidgetFormInputHidden(),
      'leg_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Legs'), 'add_empty' => false)),
      'instructions'     => new sfWidgetFormTextarea(),
      'distance'         => new sfWidgetFormInputText(),
      'duration'         => new sfWidgetFormInputText(),
      'encoded_polyline' => new sfWidgetFormTextarea(),
      'sequence_order'   => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'step_id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('step_id')), 'empty_value' => $this->getObject()->get('step_id'), 'required' => false)),
      'leg_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Legs'))),
      'instructions'     => new sfValidatorString(array('required' => false)),
      'distance'         => new sfValidatorInteger(array('required' => false)),
      'duration'         => new sfValidatorInteger(array('required' => false)),
      'encoded_polyline' => new sfValidatorString(array('required' => false)),
      'sequence_order'   => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('steps[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Steps';
  }

}
