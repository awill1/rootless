<?php

/**
 * Seats filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'carpool_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => true)),
      'passenger_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'add_empty' => true)),
      'seat_status_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SeatStatuses'), 'add_empty' => true)),
      'solo_route_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => true)),
      'price'                   => new sfWidgetFormFilterInput(),
      'seat_count'              => new sfWidgetFormFilterInput(),
      'pickup_date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pickup_time'             => new sfWidgetFormFilterInput(),
      'description'             => new sfWidgetFormFilterInput(),
      'is_hidden_for_driver'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_hidden_for_passenger' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'carpool_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carpools'), 'column' => 'carpool_id')),
      'passenger_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Passengers'), 'column' => 'passenger_id')),
      'seat_status_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SeatStatuses'), 'column' => 'seat_status_id')),
      'solo_route_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Routes'), 'column' => 'route_id')),
      'price'                   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'seat_count'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pickup_date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pickup_time'             => new sfValidatorPass(array('required' => false)),
      'description'             => new sfValidatorPass(array('required' => false)),
      'is_hidden_for_driver'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_hidden_for_passenger' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seats_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seats';
  }

  public function getFields()
  {
    return array(
      'seat_id'                 => 'Number',
      'carpool_id'              => 'ForeignKey',
      'passenger_id'            => 'ForeignKey',
      'seat_status_id'          => 'ForeignKey',
      'solo_route_id'           => 'ForeignKey',
      'price'                   => 'Number',
      'seat_count'              => 'Number',
      'pickup_date'             => 'Date',
      'pickup_time'             => 'Text',
      'description'             => 'Text',
      'is_hidden_for_driver'    => 'Boolean',
      'is_hidden_for_passenger' => 'Boolean',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
