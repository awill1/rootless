<?php

/**
 * Seatrequests filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatrequestsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'driverid'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'passengerid'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'), 'add_empty' => true)),
      'createdon'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'driverid'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'passengerid'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles_2'), 'column' => 'idprofile')),
      'createdon'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('seatrequests_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seatrequests';
  }

  public function getFields()
  {
    return array(
      'idseatrequest' => 'Number',
      'driverid'      => 'ForeignKey',
      'passengerid'   => 'ForeignKey',
      'createdon'     => 'Date',
    );
  }
}
