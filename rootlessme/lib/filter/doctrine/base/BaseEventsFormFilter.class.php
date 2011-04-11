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
      'name'          => new sfWidgetFormFilterInput(),
      'date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'time'          => new sfWidgetFormFilterInput(),
      'pictureurl'    => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'url'           => new sfWidgetFormFilterInput(),
      'certification' => new sfWidgetFormFilterInput(),
      'createdby'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'location'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => true)),
      'createdon'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedon'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'          => new sfValidatorPass(array('required' => false)),
      'pictureurl'    => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'url'           => new sfValidatorPass(array('required' => false)),
      'certification' => new sfValidatorPass(array('required' => false)),
      'createdby'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'location'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations'), 'column' => 'idlocation')),
      'createdon'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedon'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
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
      'idevent'       => 'Number',
      'name'          => 'Text',
      'date'          => 'Date',
      'time'          => 'Text',
      'pictureurl'    => 'Text',
      'description'   => 'Text',
      'url'           => 'Text',
      'certification' => 'Text',
      'createdby'     => 'ForeignKey',
      'location'      => 'ForeignKey',
      'createdon'     => 'Date',
      'modifiedon'    => 'Date',
    );
  }
}
