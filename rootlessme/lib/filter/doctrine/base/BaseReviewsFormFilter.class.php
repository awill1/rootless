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
      'reviewer'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'reviewee'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles_2'), 'add_empty' => true)),
      'safetyrating'       => new sfWidgetFormFilterInput(),
      'friendlinessrating' => new sfWidgetFormFilterInput(),
      'punctualityrating'  => new sfWidgetFormFilterInput(),
      'courtesyrating'     => new sfWidgetFormFilterInput(),
      'comments'           => new sfWidgetFormFilterInput(),
      'createdon'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'driverreview'       => new sfWidgetFormFilterInput(),
      'passengerreview'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'reviewer'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'reviewee'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles_2'), 'column' => 'idprofile')),
      'safetyrating'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'friendlinessrating' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'punctualityrating'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'courtesyrating'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comments'           => new sfValidatorPass(array('required' => false)),
      'createdon'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'driverreview'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'passengerreview'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'ratingid'           => 'Number',
      'reviewer'           => 'ForeignKey',
      'reviewee'           => 'ForeignKey',
      'safetyrating'       => 'Number',
      'friendlinessrating' => 'Number',
      'punctualityrating'  => 'Number',
      'courtesyrating'     => 'Number',
      'comments'           => 'Text',
      'createdon'          => 'Date',
      'driverreview'       => 'Number',
      'passengerreview'    => 'Number',
    );
  }
}
