<?php

/**
 * AttendingStatusType form base class.
 *
 * @method AttendingStatusType getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAttendingStatusTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'attending_status_type_id' => new sfWidgetFormInputHidden(),
      'display_text'             => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'attending_status_type_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('attending_status_type_id')), 'empty_value' => $this->getObject()->get('attending_status_type_id'), 'required' => false)),
      'display_text'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'               => new sfValidatorDateTime(array('required' => false)),
      'updated_at'               => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attending_status_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttendingStatusType';
  }

}
