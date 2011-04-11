<?php

/**
 * Securitysettings filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSecuritysettingsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'canemailpromotions' => new sfWidgetFormFilterInput(),
      'canemailpartners'   => new sfWidgetFormFilterInput(),
      'users_username'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'canemailpromotions' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'canemailpartners'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'users_username'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Users'), 'column' => 'username')),
    ));

    $this->widgetSchema->setNameFormat('securitysettings_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Securitysettings';
  }

  public function getFields()
  {
    return array(
      'idsecuritysettings' => 'Number',
      'canemailpromotions' => 'Number',
      'canemailpartners'   => 'Number',
      'users_username'     => 'ForeignKey',
    );
  }
}
