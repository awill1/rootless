<?php

/**
 * Negotiation filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNegotiationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'price'             => new sfWidgetFormFilterInput(),
      'numberofseats'     => new sfWidgetFormFilterInput(),
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'time'              => new sfWidgetFormFilterInput(),
      'comments'          => new sfWidgetFormFilterInput(),
      'idnegotiationtype' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Negotiationtypes'), 'add_empty' => true)),
      'pickuplocation'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => true)),
      'dropofflocation'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_4'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'price'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numberofseats'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'              => new sfValidatorPass(array('required' => false)),
      'comments'          => new sfValidatorPass(array('required' => false)),
      'idnegotiationtype' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Negotiationtypes'), 'column' => 'idnegotiationtype')),
      'pickuplocation'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations'), 'column' => 'idlocation')),
      'dropofflocation'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locations_4'), 'column' => 'idlocation')),
    ));

    $this->widgetSchema->setNameFormat('negotiation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Negotiation';
  }

  public function getFields()
  {
    return array(
      'idnegotiation'     => 'Number',
      'price'             => 'Number',
      'numberofseats'     => 'Number',
      'date'              => 'Date',
      'time'              => 'Text',
      'comments'          => 'Text',
      'idseatrequest'     => 'Number',
      'idnegotiationtype' => 'ForeignKey',
      'pickuplocation'    => 'ForeignKey',
      'dropofflocation'   => 'ForeignKey',
    );
  }
}
