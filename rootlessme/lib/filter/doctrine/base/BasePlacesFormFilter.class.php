<?php

/**
 * Places filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlacesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'website_url'           => new sfWidgetFormFilterInput(),
      'isPartner'             => new sfWidgetFormFilterInput(),
      'contact_email_address' => new sfWidgetFormFilterInput(),
      'contact_phone_number'  => new sfWidgetFormFilterInput(),
      'logo_url'              => new sfWidgetFormFilterInput(),
      'index_image_url'       => new sfWidgetFormFilterInput(),
      'tags'                  => new sfWidgetFormFilterInput(),
      'css_style'             => new sfWidgetFormFilterInput(),
      'location_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
      'is_deleted'            => new sfWidgetFormFilterInput(),
      'slug'                  => new sfWidgetFormFilterInput(),
      'share_image_url'       => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'website_url'           => new sfValidatorPass(array('required' => false)),
      'isPartner'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contact_email_address' => new sfValidatorPass(array('required' => false)),
      'contact_phone_number'  => new sfValidatorPass(array('required' => false)),
      'logo_url'              => new sfValidatorPass(array('required' => false)),
      'index_image_url'       => new sfValidatorPass(array('required' => false)),
      'tags'                  => new sfValidatorPass(array('required' => false)),
      'css_style'             => new sfValidatorPass(array('required' => false)),
      'location_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Location'), 'column' => 'location_id')),
      'is_deleted'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'                  => new sfValidatorPass(array('required' => false)),
      'share_image_url'       => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('places_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Places';
  }

  public function getFields()
  {
    return array(
      'place_id'              => 'Number',
      'name'                  => 'Text',
      'website_url'           => 'Text',
      'isPartner'             => 'Number',
      'contact_email_address' => 'Text',
      'contact_phone_number'  => 'Text',
      'logo_url'              => 'Text',
      'index_image_url'       => 'Text',
      'tags'                  => 'Text',
      'css_style'             => 'Text',
      'location_id'           => 'ForeignKey',
      'is_deleted'            => 'Number',
      'slug'                  => 'Text',
      'share_image_url'       => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
