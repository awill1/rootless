<?php

/**
 * Events filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subheading'            => new sfWidgetFormFilterInput(),
      'start_date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'end_date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'website_url'           => new sfWidgetFormFilterInput(),
      'isPartner'             => new sfWidgetFormFilterInput(),
      'contact_email_address' => new sfWidgetFormFilterInput(),
      'contact_phone_number'  => new sfWidgetFormFilterInput(),
      'index_image_url'       => new sfWidgetFormFilterInput(),
      'tags'                  => new sfWidgetFormFilterInput(),
      'css_style'             => new sfWidgetFormFilterInput(),
      'is_deleted'            => new sfWidgetFormFilterInput(),
      'slug'                  => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'subheading'            => new sfValidatorPass(array('required' => false)),
      'start_date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end_date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'website_url'           => new sfValidatorPass(array('required' => false)),
      'isPartner'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contact_email_address' => new sfValidatorPass(array('required' => false)),
      'contact_phone_number'  => new sfValidatorPass(array('required' => false)),
      'index_image_url'       => new sfValidatorPass(array('required' => false)),
      'tags'                  => new sfValidatorPass(array('required' => false)),
      'css_style'             => new sfValidatorPass(array('required' => false)),
      'is_deleted'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'                  => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('events_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

  public function getFields()
  {
    return array(
      'event_id'              => 'Number',
      'name'                  => 'Text',
      'subheading'            => 'Text',
      'start_date'            => 'Date',
      'end_date'              => 'Date',
      'website_url'           => 'Text',
      'isPartner'             => 'Number',
      'contact_email_address' => 'Text',
      'contact_phone_number'  => 'Text',
      'index_image_url'       => 'Text',
      'tags'                  => 'Text',
      'css_style'             => 'Text',
      'is_deleted'            => 'Number',
      'slug'                  => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
