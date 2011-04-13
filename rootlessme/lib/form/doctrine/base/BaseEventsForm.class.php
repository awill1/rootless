<?php

/**
 * Events form base class.
 *
 * @method Events getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'event_id'          => new sfWidgetFormInputHidden(),
      'location_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'), 'add_empty' => false)),
      'name'              => new sfWidgetFormInputText(),
      'date'              => new sfWidgetFormDate(),
      'time'              => new sfWidgetFormTime(),
      'picture_url_large' => new sfWidgetFormInputText(),
      'picture_url_small' => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'website_url'       => new sfWidgetFormInputText(),
      'certification'     => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'event_id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('event_id')), 'empty_value' => $this->getObject()->get('event_id'), 'required' => false)),
      'location_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locations'))),
      'name'              => new sfValidatorString(array('max_length' => 45)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'time'              => new sfValidatorTime(array('required' => false)),
      'picture_url_large' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture_url_small' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'website_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'certification'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
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
