<?php

/**
 * Steps filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStepsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'leg_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Legs'), 'add_empty' => true)),
      'instructions'     => new sfWidgetFormFilterInput(),
      'distance'         => new sfWidgetFormFilterInput(),
      'duration'         => new sfWidgetFormFilterInput(),
      'encoded_polyline' => new sfWidgetFormFilterInput(),
      'sequence_order'   => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'leg_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Legs'), 'column' => 'leg_id')),
      'instructions'     => new sfValidatorPass(array('required' => false)),
      'distance'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'duration'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'encoded_polyline' => new sfValidatorPass(array('required' => false)),
      'sequence_order'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('steps_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Steps';
  }

  public function getFields()
  {
    return array(
      'step_id'          => 'Number',
      'leg_id'           => 'ForeignKey',
      'instructions'     => 'Text',
      'distance'         => 'Number',
      'duration'         => 'Number',
      'encoded_polyline' => 'Text',
      'sequence_order'   => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
