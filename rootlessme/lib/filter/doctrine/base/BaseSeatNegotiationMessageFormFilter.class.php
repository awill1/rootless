<?php

/**
 * SeatNegotiationMessage filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatNegotiationMessageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_negotiation_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiations'), 'add_empty' => true)),
      'author_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'message'                     => new sfWidgetFormFilterInput(),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'seat_negotiation_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SeatNegotiations'), 'column' => 'seat_negotiation_id')),
      'author_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'message'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seat_negotiation_message_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatNegotiationMessage';
  }

  public function getFields()
  {
    return array(
      'seat_negotiation_message_id' => 'Number',
      'seat_negotiation_id'         => 'ForeignKey',
      'author_id'                   => 'ForeignKey',
      'message'                     => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
