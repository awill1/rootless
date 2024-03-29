<?php

/**
 * Passengers filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePassengersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'person_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'solo_route_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Routes'), 'add_empty' => true)),
      'passenger_count' => new sfWidgetFormFilterInput(),
      'start_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'start_time'      => new sfWidgetFormFilterInput(),
      'asking_price'    => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'isPublic'        => new sfWidgetFormFilterInput(),
      'status_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'person_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'solo_route_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Routes'), 'column' => 'route_id')),
      'passenger_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'start_time'      => new sfValidatorPass(array('required' => false)),
      'asking_price'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'description'     => new sfValidatorPass(array('required' => false)),
      'isPublic'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('passengers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Passengers';
  }

  public function getFields()
  {
    return array(
      'passenger_id'    => 'Number',
      'person_id'       => 'ForeignKey',
      'solo_route_id'   => 'ForeignKey',
      'passenger_count' => 'Number',
      'start_date'      => 'Date',
      'start_time'      => 'Text',
      'asking_price'    => 'Number',
      'description'     => 'Text',
      'isPublic'        => 'Number',
      'status_id'       => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
