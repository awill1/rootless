<?php

/**
 * Messages filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMessagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject'          => new sfWidgetFormFilterInput(),
      'body'             => new sfWidgetFormFilterInput(),
      'sender'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profiles'), 'add_empty' => true)),
      'createdon'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'repliedtomessage' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'subject'          => new sfValidatorPass(array('required' => false)),
      'body'             => new sfValidatorPass(array('required' => false)),
      'sender'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profiles'), 'column' => 'idprofile')),
      'createdon'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'repliedtomessage' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('messages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Messages';
  }

  public function getFields()
  {
    return array(
      'idmessages'       => 'Number',
      'subject'          => 'Text',
      'body'             => 'Text',
      'sender'           => 'ForeignKey',
      'createdon'        => 'Date',
      'repliedtomessage' => 'Number',
    );
  }
}
