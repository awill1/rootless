<?php

/**
 * SeatsHistory filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatsHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seat_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seats'), 'add_empty' => true)),
      'carpool_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'passenger_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seat_status_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seat_request_type_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'solo_route_id'        => new sfWidgetFormFilterInput(),
      'price'                => new sfWidgetFormFilterInput(),
      'seat_count'           => new sfWidgetFormFilterInput(),
      'pickup_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pickup_time'          => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'changer_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'change_action'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'seat_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Seats'), 'column' => 'seat_id')),
      'carpool_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'passenger_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'seat_status_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'seat_request_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'solo_route_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'seat_count'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pickup_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pickup_time'          => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'changer_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'change_action'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seats_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeatsHistory';
  }

  public function getFields()
  {
    return array(
      'seat_history_id'      => 'Number',
      'seat_id'              => 'ForeignKey',
      'carpool_id'           => 'Number',
      'passenger_id'         => 'Number',
      'seat_status_id'       => 'Number',
      'seat_request_type_id' => 'Number',
      'solo_route_id'        => 'Number',
      'price'                => 'Number',
      'seat_count'           => 'Number',
      'pickup_date'          => 'Date',
      'pickup_time'          => 'Text',
      'description'          => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'changer_id'           => 'ForeignKey',
      'change_action'        => 'Text',
    );
  }
}
