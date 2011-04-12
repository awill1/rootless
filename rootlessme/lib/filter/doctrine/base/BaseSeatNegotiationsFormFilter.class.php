<?php

/**
 * SeatNegotiations filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatNegotiationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proposed_route_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => true)),
      'seat_negotiation_statuses_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatNegotiationStatuses'), 'add_empty' => true)),
      'carpool_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => true)),
      'passenger_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'add_empty' => true)),
      'price'                        => new sfWidgetFormFilterInput(),
      'seat_count'                   => new sfWidgetFormFilterInput(),
      'pickup_date'                  => new sfWidgetFormFilterInput(),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pickup_time'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'proposed_route_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Routes'), 'column' => 'route_id')),
      'seat_negotiation_statuses_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SeatNegotiationStatuses'), 'column' => 'seat_negotiation_statuses_id')),
      'carpool_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carpools'), 'column' => 'carpool_id')),
      'passenger_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Passengers'), 'column' => 'passenger_id')),
      'price'                        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'seat_count'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pickup_date'                  => new sfValidatorPass(array('required' => false)),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'pickup_time'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seat_negotiations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatNegotiations';
  }

  public function getFields()
  {
    return array(
      'seat_negotiation_id'          => 'Number',
      'proposed_route_id'            => 'ForeignKey',
      'seat_negotiation_statuses_id' => 'ForeignKey',
      'carpool_id'                   => 'ForeignKey',
      'passenger_id'                 => 'ForeignKey',
      'price'                        => 'Number',
      'seat_count'                   => 'Number',
      'pickup_date'                  => 'Text',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
      'pickup_time'                  => 'Text',
    );
  }
}
