<?php

/**
 * Events filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'location_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'time'              => new sfWidgetFormFilterInput(),
      'picture_url_large' => new sfWidgetFormFilterInput(),
      'picture_url_small' => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'website_url'       => new sfWidgetFormFilterInput(),
      'certification'     => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'location_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations'), 'column' => 'location_id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'              => new sfValidatorPass(array('required' => false)),
      'picture_url_large' => new sfValidatorPass(array('required' => false)),
      'picture_url_small' => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'website_url'       => new sfValidatorPass(array('required' => false)),
      'certification'     => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('events_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

  public function getFields()
  {
    return array(
      'event_id'          => 'Number',
      'location_id'       => 'ForeignKey',
      'name'              => 'Text',
      'date'              => 'Date',
      'time'              => 'Text',
      'picture_url_large' => 'Text',
      'picture_url_small' => 'Text',
      'description'       => 'Text',
      'website_url'       => 'Text',
      'certification'     => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
