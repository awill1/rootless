<?php

/**
 * Reviews filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReviewsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reviewer_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'reviewee_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People_2'), 'add_empty' => true)),
      'was_safe'         => new sfWidgetFormFilterInput(),
      'was_friendly'     => new sfWidgetFormFilterInput(),
      'was_punctual'     => new sfWidgetFormFilterInput(),
      'was_courteous'    => new sfWidgetFormFilterInput(),
      'comments'         => new sfWidgetFormFilterInput(),
      'driver_review'    => new sfWidgetFormFilterInput(),
      'passenger_review' => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'reviewer_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'reviewee_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People_2'), 'column' => 'person_id')),
      'was_safe'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'was_friendly'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'was_punctual'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'was_courteous'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comments'         => new sfValidatorPass(array('required' => false)),
      'driver_review'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'passenger_review' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('reviews_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reviews';
  }

  public function getFields()
  {
    return array(
      'rating_id'        => 'Number',
      'reviewer_id'      => 'ForeignKey',
      'reviewee_id'      => 'ForeignKey',
      'was_safe'         => 'Number',
      'was_friendly'     => 'Number',
      'was_punctual'     => 'Number',
      'was_courteous'    => 'Number',
      'comments'         => 'Text',
      'driver_review'    => 'Number',
      'passenger_review' => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
