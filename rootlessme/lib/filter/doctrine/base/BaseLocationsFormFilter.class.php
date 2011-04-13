<?php

/**
 * Locations filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLocationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'step_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Steps'), 'add_empty' => true)),
      'name'           => new sfWidgetFormFilterInput(),
      'street_1'       => new sfWidgetFormFilterInput(),
      'street_2'       => new sfWidgetFormFilterInput(),
      'city'           => new sfWidgetFormFilterInput(),
      'state'          => new sfWidgetFormFilterInput(),
      'postal_code'    => new sfWidgetFormFilterInput(),
      'country'        => new sfWidgetFormFilterInput(),
      'latitude'       => new sfWidgetFormFilterInput(),
      'longitude'      => new sfWidgetFormFilterInput(),
      'search_string'  => new sfWidgetFormFilterInput(),
      'sequence_order' => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'step_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Steps'), 'column' => 'step_id')),
      'name'           => new sfValidatorPass(array('required' => false)),
      'street_1'       => new sfValidatorPass(array('required' => false)),
      'street_2'       => new sfValidatorPass(array('required' => false)),
      'city'           => new sfValidatorPass(array('required' => false)),
      'state'          => new sfValidatorPass(array('required' => false)),
      'postal_code'    => new sfValidatorPass(array('required' => false)),
      'country'        => new sfValidatorPass(array('required' => false)),
      'latitude'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'search_string'  => new sfValidatorPass(array('required' => false)),
      'sequence_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('locations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Locations';
  }

  public function getFields()
  {
    return array(
      'location_id'    => 'Number',
      'step_id'        => 'ForeignKey',
      'name'           => 'Text',
      'street_1'       => 'Text',
      'street_2'       => 'Text',
      'city'           => 'Text',
      'state'          => 'Text',
      'postal_code'    => 'Text',
      'country'        => 'Text',
      'latitude'       => 'Number',
      'longitude'      => 'Number',
      'search_string'  => 'Text',
      'sequence_order' => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
