<?php

/**
 * Attendingstatustype filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttendingstatustypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'status'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attendingstatustype_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attendingstatustype';
  }

  public function getFields()
  {
    return array(
      'idattendingstatustype' => 'Number',
      'status'                => 'Text',
    );
  }
}
