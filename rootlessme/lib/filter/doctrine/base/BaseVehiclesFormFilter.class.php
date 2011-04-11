<?php

/**
 * Vehicles filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVehiclesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'seatcount'         => new sfWidgetFormFilterInput(),
      'gasmilage'         => new sfWidgetFormFilterInput(),
      'year'              => new sfWidgetFormFilterInput(),
      'make'              => new sfWidgetFormFilterInput(),
      'model'             => new sfWidgetFormFilterInput(),
      'color'             => new sfWidgetFormFilterInput(),
      'licenseplate'      => new sfWidgetFormFilterInput(),
      'baggagecount'      => new sfWidgetFormFilterInput(),
      'travelers_idusers' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'createdon'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'comments'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'seatcount'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gasmilage'         => new sfValidatorPass(array('required' => false)),
      'year'              => new sfValidatorPass(array('required' => false)),
      'make'              => new sfValidatorPass(array('required' => false)),
      'model'             => new sfValidatorPass(array('required' => false)),
      'color'             => new sfValidatorPass(array('required' => false)),
      'licenseplate'      => new sfValidatorPass(array('required' => false)),
      'baggagecount'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'travelers_idusers' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'createdon'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'comments'          => new sfValidatorPass(array('required' => false)),
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
      'idvehicle'         => 'Number',
      'seatcount'         => 'Number',
      'gasmilage'         => 'Text',
      'year'              => 'Text',
      'make'              => 'Text',
      'model'             => 'Text',
      'color'             => 'Text',
      'licenseplate'      => 'Text',
      'baggagecount'      => 'Number',
      'travelers_idusers' => 'ForeignKey',
      'createdon'         => 'Date',
      'comments'          => 'Text',
    );
  }
}
