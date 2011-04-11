<?php

/**
 * Locations filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLocationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(),
      'street 1'     => new sfWidgetFormFilterInput(),
      'street 2'     => new sfWidgetFormFilterInput(),
      'city'         => new sfWidgetFormFilterInput(),
      'state'        => new sfWidgetFormFilterInput(),
      'postalcode'   => new sfWidgetFormFilterInput(),
      'country'      => new sfWidgetFormFilterInput(),
      'latitude'     => new sfWidgetFormFilterInput(),
      'longitude'    => new sfWidgetFormFilterInput(),
      'searchstring' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'street 1'     => new sfValidatorPass(array('required' => false)),
      'street 2'     => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'state'        => new sfValidatorPass(array('required' => false)),
      'postalcode'   => new sfValidatorPass(array('required' => false)),
      'country'      => new sfValidatorPass(array('required' => false)),
      'latitude'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'searchstring' => new sfValidatorPass(array('required' => false)),
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
      'idlocation'   => 'Number',
      'name'         => 'Text',
      'street 1'     => 'Text',
      'street 2'     => 'Text',
      'city'         => 'Text',
      'state'        => 'Text',
      'postalcode'   => 'Text',
      'country'      => 'Text',
      'latitude'     => 'Number',
      'longitude'    => 'Number',
      'searchstring' => 'Text',
    );
  }
}
