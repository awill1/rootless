<?php

/**
 * Users filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'person_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => true)),
      'email'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'encrypted_password' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'person_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('People'), 'column' => 'person_id')),
      'email'              => new sfValidatorPass(array('required' => false)),
      'encrypted_password' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'user_name'          => 'Text',
      'person_id'          => 'ForeignKey',
      'email'              => 'Text',
      'encrypted_password' => 'Text',
    );
  }
}
