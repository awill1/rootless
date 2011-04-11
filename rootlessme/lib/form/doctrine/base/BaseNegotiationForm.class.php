<?php

/**
 * Negotiation form base class.
 *
 * @method Negotiation getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNegotiationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idnegotiation'     => new sfWidgetFormInputHidden(),
      'price'             => new sfWidgetFormInputText(),
      'numberofseats'     => new sfWidgetFormInputText(),
      'date'              => new sfWidgetFormDate(),
      'time'              => new sfWidgetFormTime(),
      'comments'          => new sfWidgetFormTextarea(),
      'idseatrequest'     => new sfWidgetFormInputHidden(),
      'idnegotiationtype' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Negotiationtypes'), 'add_empty' => false)),
      'pickuplocation'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => false)),
      'dropofflocation'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_4'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idnegotiation'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idnegotiation')), 'empty_value' => $this->getObject()->get('idnegotiation'), 'required' => false)),
      'price'             => new sfValidatorNumber(array('required' => false)),
      'numberofseats'     => new sfValidatorInteger(array('required' => false)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'time'              => new sfValidatorTime(array('required' => false)),
      'comments'          => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'idseatrequest'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idseatrequest')), 'empty_value' => $this->getObject()->get('idseatrequest'), 'required' => false)),
      'idnegotiationtype' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Negotiationtypes'))),
      'pickuplocation'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'))),
      'dropofflocation'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_4'))),
    ));

    $this->widgetSchema->setNameFormat('negotiation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Negotiation';
  }

}
