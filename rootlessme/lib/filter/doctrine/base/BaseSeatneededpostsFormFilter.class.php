<?php

/**
 * Seatneededposts filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeatneededpostsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'travelers_idusers' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'price'             => new sfWidgetFormFilterInput(),
      'numberofseats'     => new sfWidgetFormFilterInput(),
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'time'              => new sfWidgetFormFilterInput(),
      'comments'          => new sfWidgetFormFilterInput(),
      'pickuplocation'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => true)),
      'dropofflocation'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'travelers_idusers' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'price'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numberofseats'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'              => new sfValidatorPass(array('required' => false)),
      'comments'          => new sfValidatorPass(array('required' => false)),
      'pickuplocation'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations'), 'column' => 'idlocation')),
      'dropofflocation'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations_3'), 'column' => 'idlocation')),
    ));

    $this->widgetSchema->setNameFormat('seatneededposts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seatneededposts';
  }

  public function getFields()
  {
    return array(
      'idseatneededpost'  => 'Number',
      'travelers_idusers' => 'ForeignKey',
      'price'             => 'Number',
      'numberofseats'     => 'Number',
      'date'              => 'Date',
      'time'              => 'Text',
      'comments'          => 'Text',
      'pickuplocation'    => 'ForeignKey',
      'dropofflocation'   => 'ForeignKey',
    );
  }
}
