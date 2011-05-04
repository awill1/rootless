<?php

/**
 * SecuritySettings filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSecuritySettingsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'person_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'can_email_promotions' => new sfWidgetFormFilterInput(),
      'can_email_partners'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'person_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'can_email_promotions' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'can_email_partners'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('security_settings_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SecuritySettings';
  }

  public function getFields()
  {
    return array(
      'security_settings_id' => 'Number',
      'person_id'            => 'ForeignKey',
      'can_email_promotions' => 'Number',
      'can_email_partners'   => 'Number',
    );
  }
}
