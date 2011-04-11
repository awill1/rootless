<?php

/**
 * Seatneededposts form base class.
 *
 * @method Seatneededposts getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeatneededpostsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idseatneededpost'  => new sfWidgetFormInputHidden(),
      'travelers_idusers' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'price'             => new sfWidgetFormInputText(),
      'numberofseats'     => new sfWidgetFormInputText(),
      'date'              => new sfWidgetFormDate(),
      'time'              => new sfWidgetFormTime(),
      'comments'          => new sfWidgetFormTextarea(),
      'pickuplocation'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => false)),
      'dropofflocation'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idseatneededpost'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idseatneededpost')), 'empty_value' => $this->getObject()->get('idseatneededpost'), 'required' => false)),
      'travelers_idusers' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'price'             => new sfValidatorNumber(array('required' => false)),
      'numberofseats'     => new sfValidatorInteger(array('required' => false)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'time'              => new sfValidatorTime(array('required' => false)),
      'comments'          => new sfValidatorString(array('required' => false)),
      'pickuplocation'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'))),
      'dropofflocation'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations_3'))),
    ));

    $this->widgetSchema->setNameFormat('seatneededposts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seatneededposts';
  }

}
