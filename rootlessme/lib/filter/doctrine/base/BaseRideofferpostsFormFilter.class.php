<?php

/**
 * Rideofferposts filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRideofferpostsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'travelers_idusers'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'price'              => new sfWidgetFormFilterInput(),
      'numberofseats'      => new sfWidgetFormFilterInput(),
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'time'               => new sfWidgetFormFilterInput(),
      'comments'           => new sfWidgetFormFilterInput(),
      'origin'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => true)),
      'destination'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'), 'add_empty' => true)),
      'vehicles_idvehicle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vehicles'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'travelers_idusers'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'profile_name')),
      'price'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numberofseats'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'               => new sfValidatorPass(array('required' => false)),
      'comments'           => new sfValidatorPass(array('required' => false)),
      'origin'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations'), 'column' => 'location_id')),
      'destination'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations_3'), 'column' => 'location_id')),
      'vehicles_idvehicle' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vehicles'), 'column' => 'vehicle_id')),
    ));

    $this->widgetSchema->setNameFormat('rideofferposts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rideofferposts';
  }

  public function getFields()
  {
    return array(
      'idrideofferpost'    => 'Number',
      'travelers_idusers'  => 'ForeignKey',
      'price'              => 'Number',
      'numberofseats'      => 'Number',
      'date'               => 'Date',
      'time'               => 'Text',
      'comments'           => 'Text',
      'origin'             => 'ForeignKey',
      'destination'        => 'ForeignKey',
      'vehicles_idvehicle' => 'ForeignKey',
    );
  }
}
