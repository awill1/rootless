<?php

/**
 * TravelersAttendingEvent filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTravelersAttendingEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Attendingstatustype'), 'add_empty' => true)),
      'createdon'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedon'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'status'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Attendingstatustype'), 'column' => 'idattendingstatustype')),
      'createdon'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedon'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('travelers_attending_event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TravelersAttendingEvent';
  }

  public function getFields()
  {
    return array(
      'events_idevent'       => 'Number',
      'travelers_idtraveler' => 'Text',
      'status'               => 'ForeignKey',
      'createdon'            => 'Date',
      'modifiedon'           => 'Date',
    );
  }
}
