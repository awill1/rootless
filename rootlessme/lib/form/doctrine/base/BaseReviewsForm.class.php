<?php

/**
 * Reviews form base class.
 *
 * @method Reviews getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReviewsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ratingid'           => new sfWidgetFormInputHidden(),
      'reviewer'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => false)),
      'reviewee'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'), 'add_empty' => false)),
      'safetyrating'       => new sfWidgetFormInputText(),
      'friendlinessrating' => new sfWidgetFormInputText(),
      'punctualityrating'  => new sfWidgetFormInputText(),
      'courtesyrating'     => new sfWidgetFormInputText(),
      'comments'           => new sfWidgetFormTextarea(),
      'createdon'          => new sfWidgetFormDateTime(),
      'driverreview'       => new sfWidgetFormInputText(),
      'passengerreview'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ratingid'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ratingid')), 'empty_value' => $this->getObject()->get('ratingid'), 'required' => false)),
      'reviewer'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'))),
      'reviewee'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'))),
      'safetyrating'       => new sfValidatorInteger(array('required' => false)),
      'friendlinessrating' => new sfValidatorInteger(array('required' => false)),
      'punctualityrating'  => new sfValidatorInteger(array('required' => false)),
      'courtesyrating'     => new sfValidatorInteger(array('required' => false)),
      'comments'           => new sfValidatorString(array('required' => false)),
      'createdon'          => new sfValidatorDateTime(array('required' => false)),
      'driverreview'       => new sfValidatorInteger(array('required' => false)),
      'passengerreview'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reviews[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reviews';
  }

}
