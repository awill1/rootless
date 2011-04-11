<?php

/**
 * Attendingstatustype form base class.
 *
 * @method Attendingstatustype getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAttendingstatustypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idattendingstatustype' => new sfWidgetFormInputHidden(),
      'status'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idattendingstatustype' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idattendingstatustype')), 'empty_value' => $this->getObject()->get('idattendingstatustype'), 'required' => false)),
      'status'                => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attendingstatustype[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attendingstatustype';
  }

}
