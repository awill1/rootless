<?php

/**
 * TravelersAttendingEvent form base class.
 *
 * @method TravelersAttendingEvent getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTravelersAttendingEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'events_idevent'       => new sfWidgetFormInputHidden(),
      'travelers_idtraveler' => new sfWidgetFormInputHidden(),
      'status'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Attendingstatustype'), 'add_empty' => false)),
      'createdon'            => new sfWidgetFormDateTime(),
      'modifiedon'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'events_idevent'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('events_idevent')), 'empty_value' => $this->getObject()->get('events_idevent'), 'required' => false)),
      'travelers_idtraveler' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('travelers_idtraveler')), 'empty_value' => $this->getObject()->get('travelers_idtraveler'), 'required' => false)),
      'status'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Attendingstatustype'))),
      'createdon'            => new sfValidatorDateTime(array('required' => false)),
      'modifiedon'           => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('travelers_attending_event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TravelersAttendingEvent';
  }

}
