<?php

/**
 * Waypoints filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWaypointsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sequence'                       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sequence'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('waypoints_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Waypoints';
  }

  public function getFields()
  {
    return array(
      'rideofferposts_idrideofferpost' => 'Number',
      'locations_idlocation'           => 'Number',
      'sequence'                       => 'Number',
    );
  }
}
