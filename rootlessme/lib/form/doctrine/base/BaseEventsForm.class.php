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
      'event_id'              => new sfWidgetFormInputHidden(),
      'place_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Places'), 'add_empty' => true)),
      'name'                  => new sfWidgetFormInputText(),
      'subheading'            => new sfWidgetFormInputText(),
      'start_date'            => new sfWidgetFormDate(),
      'end_date'              => new sfWidgetFormDate(),
      'website_url'           => new sfWidgetFormInputText(),
      'isPartner'             => new sfWidgetFormInputText(),
      'contact_email_address' => new sfWidgetFormInputText(),
      'contact_phone_number'  => new sfWidgetFormInputText(),
      'index_image_url'       => new sfWidgetFormInputText(),
      'tags'                  => new sfWidgetFormInputText(),
      'css_style'             => new sfWidgetFormTextarea(),
      'is_deleted'            => new sfWidgetFormInputText(),
      'slug'                  => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'event_id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('event_id')), 'empty_value' => $this->getObject()->get('event_id'), 'required' => false)),
      'place_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Places'), 'required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 45)),
      'subheading'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'start_date'            => new sfValidatorDate(array('required' => false)),
      'end_date'              => new sfValidatorDate(array('required' => false)),
      'website_url'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'isPartner'             => new sfValidatorInteger(array('required' => false)),
      'contact_email_address' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contact_phone_number'  => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'index_image_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tags'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'css_style'             => new sfValidatorString(array('required' => false)),
      'is_deleted'            => new sfValidatorInteger(array('required' => false)),
      'slug'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Events', 'column' => array('slug')))
    );

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
