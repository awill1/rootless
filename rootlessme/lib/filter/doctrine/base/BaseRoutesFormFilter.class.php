<?php

/**
 * Routes filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoutesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'copyright'             => new sfWidgetFormFilterInput(),
      'summary'               => new sfWidgetFormFilterInput(),
      'warning'               => new sfWidgetFormFilterInput(),
      'encoded_polyline'      => new sfWidgetFormFilterInput(),
      'origin_address'        => new sfWidgetFormFilterInput(),
      'origin_city'           => new sfWidgetFormFilterInput(),
      'origin_state'          => new sfWidgetFormFilterInput(),
      'origin_latitude'       => new sfWidgetFormFilterInput(),
      'origin_longitude'      => new sfWidgetFormFilterInput(),
      'origin_place_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Origin_Places'), 'add_empty' => true)),
      'destination_address'   => new sfWidgetFormFilterInput(),
      'destination_city'      => new sfWidgetFormFilterInput(),
      'destination_state'     => new sfWidgetFormFilterInput(),
      'destination_latitude'  => new sfWidgetFormFilterInput(),
      'destination_longitude' => new sfWidgetFormFilterInput(),
      'destination_place_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destination_Places'), 'add_empty' => true)),
      'distance'              => new sfWidgetFormFilterInput(),
      'duration'              => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'copyright'             => new sfValidatorPass(array('required' => false)),
      'summary'               => new sfValidatorPass(array('required' => false)),
      'warning'               => new sfValidatorPass(array('required' => false)),
      'encoded_polyline'      => new sfValidatorPass(array('required' => false)),
      'origin_address'        => new sfValidatorPass(array('required' => false)),
      'origin_city'           => new sfValidatorPass(array('required' => false)),
      'origin_state'          => new sfValidatorPass(array('required' => false)),
      'origin_latitude'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'origin_longitude'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'origin_place_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Origin_Places'), 'column' => 'place_id')),
      'destination_address'   => new sfValidatorPass(array('required' => false)),
      'destination_city'      => new sfValidatorPass(array('required' => false)),
      'destination_state'     => new sfValidatorPass(array('required' => false)),
      'destination_latitude'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'destination_longitude' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'destination_place_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Destination_Places'), 'column' => 'place_id')),
      'distance'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'duration'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('routes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Routes';
  }

  public function getFields()
  {
    return array(
      'route_id'              => 'Number',
      'copyright'             => 'Text',
      'summary'               => 'Text',
      'warning'               => 'Text',
      'encoded_polyline'      => 'Text',
      'origin_address'        => 'Text',
      'origin_city'           => 'Text',
      'origin_state'          => 'Text',
      'origin_latitude'       => 'Number',
      'origin_longitude'      => 'Number',
      'origin_place_id'       => 'ForeignKey',
      'destination_address'   => 'Text',
      'destination_city'      => 'Text',
      'destination_state'     => 'Text',
      'destination_latitude'  => 'Number',
      'destination_longitude' => 'Number',
      'destination_place_id'  => 'ForeignKey',
      'distance'              => 'Number',
      'duration'              => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
