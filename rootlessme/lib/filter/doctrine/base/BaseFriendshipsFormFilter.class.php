<?php

/**
 * Friendships filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFriendshipsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pending'            => new sfWidgetFormFilterInput(),
      'initiatedby'        => new sfWidgetFormFilterInput(),
      'createdon'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pending'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'initiatedby'        => new sfValidatorPass(array('required' => false)),
      'createdon'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friendships_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friendships';
  }

  public function getFields()
  {
    return array(
      'travelers_idusers'  => 'Text',
      'travelers_idusers1' => 'Text',
      'pending'            => 'Number',
      'initiatedby'        => 'Text',
      'createdon'          => 'Text',
    );
  }
}
