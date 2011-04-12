<?php

/**
 * FriendshipRequests filter form base class.
 *
 * @package    RootlessMe
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFriendshipRequestsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'friendship_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FriendshipStatuses'), 'add_empty' => true)),
      'abuse'                => new sfWidgetFormFilterInput(),
      'abuse_comment'        => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'friendship_status_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FriendshipStatuses'), 'column' => 'friendship_status_id')),
      'abuse'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'abuse_comment'        => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('friendship_requests_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FriendshipRequests';
  }

  public function getFields()
  {
    return array(
      'requestor_id'         => 'Number',
      'requestee_id'         => 'Number',
      'friendship_status_id' => 'ForeignKey',
      'abuse'                => 'Number',
      'abuse_comment'        => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
