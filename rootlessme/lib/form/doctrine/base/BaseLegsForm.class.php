<?php

/**
 * Legs form base class.
 *
 * @method Legs getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLegsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'leg_id'         => new sfWidgetFormInputHidden(),
      'route_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => false)),
      'sequence_order' => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'leg_id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('leg_id')), 'empty_value' => $this->getObject()->get('leg_id'), 'required' => false)),
      'route_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'))),
      'sequence_order' => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('legs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Legs';
  }

}
