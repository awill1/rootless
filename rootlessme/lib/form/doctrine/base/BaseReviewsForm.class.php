<?php

/**
 * Reviews form base class.
 *
 * @method Reviews getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReviewsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'rating_id'        => new sfWidgetFormInputHidden(),
      'reviewer_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
      'reviewee_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People_2'), 'add_empty' => false)),
      'seat_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Seats'), 'add_empty' => true)),
      'was_safe'         => new sfWidgetFormInputText(),
      'was_friendly'     => new sfWidgetFormInputText(),
      'was_punctual'     => new sfWidgetFormInputText(),
      'was_courteous'    => new sfWidgetFormInputText(),
      'comments'         => new sfWidgetFormTextarea(),
      'driver_review'    => new sfWidgetFormInputText(),
      'passenger_review' => new sfWidgetFormInputText(),
      'ride_date'        => new sfWidgetFormDate(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'rating_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('rating_id')), 'empty_value' => $this->getObject()->get('rating_id'), 'required' => false)),
      'reviewer_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))),
      'reviewee_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People_2'))),
      'seat_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Seats'), 'required' => false)),
      'was_safe'         => new sfValidatorInteger(array('required' => false)),
      'was_friendly'     => new sfValidatorInteger(array('required' => false)),
      'was_punctual'     => new sfValidatorInteger(array('required' => false)),
      'was_courteous'    => new sfValidatorInteger(array('required' => false)),
      'comments'         => new sfValidatorString(array('required' => false)),
      'driver_review'    => new sfValidatorInteger(array('required' => false)),
      'passenger_review' => new sfValidatorInteger(array('required' => false)),
      'ride_date'        => new sfValidatorDate(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
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
