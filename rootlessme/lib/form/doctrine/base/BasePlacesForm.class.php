<?php

/**
 * Places form base class.
 *
 * @method Places getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlacesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'place_id'              => new sfWidgetFormInputHidden(),
      'name'                  => new sfWidgetFormInputText(),
      'website_url'           => new sfWidgetFormInputText(),
      'isPartner'             => new sfWidgetFormInputText(),
      'contact_email_address' => new sfWidgetFormInputText(),
      'contact_phone_number'  => new sfWidgetFormInputText(),
      'logo_url'              => new sfWidgetFormInputText(),
      'index_image_url'       => new sfWidgetFormInputText(),
      'tags'                  => new sfWidgetFormInputText(),
      'css_style'             => new sfWidgetFormTextarea(),
      'location_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
      'is_deleted'            => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'place_id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('place_id')), 'empty_value' => $this->getObject()->get('place_id'), 'required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 45)),
      'website_url'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'isPartner'             => new sfValidatorInteger(array('required' => false)),
      'contact_email_address' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contact_phone_number'  => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'logo_url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'index_image_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tags'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'css_style'             => new sfValidatorString(array('required' => false)),
      'location_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'required' => false)),
      'is_deleted'            => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('places[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Places';
  }

}
