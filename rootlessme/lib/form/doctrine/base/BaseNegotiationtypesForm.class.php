<?php

/**
 * Negotiationtypes form base class.
 *
 * @method Negotiationtypes getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNegotiationtypesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idnegotiationtype' => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'isfinal'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idnegotiationtype' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idnegotiationtype')), 'empty_value' => $this->getObject()->get('idnegotiationtype'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'isfinal'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('negotiationtypes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Negotiationtypes';
  }

}
