<?php

/**
 * Vehicles filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiclesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'person_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'seat_count'      => new sfWidgetFormFilterInput(),
      'gas_milage'      => new sfWidgetFormFilterInput(),
      'model_year'      => new sfWidgetFormFilterInput(),
      'make'            => new sfWidgetFormFilterInput(),
      'model'           => new sfWidgetFormFilterInput(),
      'color'           => new sfWidgetFormFilterInput(),
      'license_plate'   => new sfWidgetFormFilterInput(),
      'baggage_count'   => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'image_url_large' => new sfWidgetFormFilterInput(),
      'image_url_small' => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'person_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'seat_count'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gas_milage'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'model_year'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'make'            => new sfValidatorPass(array('required' => false)),
      'model'           => new sfValidatorPass(array('required' => false)),
      'color'           => new sfValidatorPass(array('required' => false)),
      'license_plate'   => new sfValidatorPass(array('required' => false)),
      'baggage_count'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'     => new sfValidatorPass(array('required' => false)),
      'image_url_large' => new sfValidatorPass(array('required' => false)),
      'image_url_small' => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vehicles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vehicles';
  }

  public function getFields()
  {
    return array(
      'vehicle_id'      => 'Number',
      'person_id'       => 'ForeignKey',
      'seat_count'      => 'Number',
      'gas_milage'      => 'Number',
      'model_year'      => 'Number',
      'make'            => 'Text',
      'model'           => 'Text',
      'color'           => 'Text',
      'license_plate'   => 'Text',
      'baggage_count'   => 'Number',
      'description'     => 'Text',
      'image_url_large' => 'Text',
      'image_url_small' => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
