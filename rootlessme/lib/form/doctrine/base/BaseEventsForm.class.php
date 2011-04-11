<?php

/**
 * Events form base class.
 *
 * @method Events getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idevent'       => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'date'          => new sfWidgetFormDate(),
      'time'          => new sfWidgetFormTime(),
      'pictureurl'    => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'url'           => new sfWidgetFormInputText(),
      'certification' => new sfWidgetFormInputText(),
      'createdby'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'location'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => false)),
      'createdon'     => new sfWidgetFormDateTime(),
      'modifiedon'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idevent'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idevent')), 'empty_value' => $this->getObject()->get('idevent'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'date'          => new sfValidatorDate(array('required' => false)),
      'time'          => new sfValidatorTime(array('required' => false)),
      'pictureurl'    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'url'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'certification' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'createdby'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'location'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'))),
      'createdon'     => new sfValidatorDateTime(array('required' => false)),
      'modifiedon'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('events[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

}
