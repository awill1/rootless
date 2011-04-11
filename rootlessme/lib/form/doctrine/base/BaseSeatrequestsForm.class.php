<?php

/**
 * Seatrequests form base class.
 *
 * @method Seatrequests getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatrequestsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idseatrequest' => new sfWidgetFormInputHidden(),
      'driverid'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'passengerid'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'), 'add_empty' => false)),
      'createdon'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idseatrequest' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idseatrequest')), 'empty_value' => $this->getObject()->get('idseatrequest'), 'required' => false)),
      'driverid'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'passengerid'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'))),
      'createdon'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seatrequests[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seatrequests';
  }

}
