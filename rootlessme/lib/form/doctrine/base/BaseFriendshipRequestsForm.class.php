<?php

/**
 * FriendshipRequests form base class.
 *
 * @method FriendshipRequests getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriendshipRequestsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'requestor_id'         => new sfWidgetFormInputHidden(),
      'requestee_id'         => new sfWidgetFormInputHidden(),
      'friendship_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FriendshipStatuses'), 'add_empty' => false)),
      'abuse'                => new sfWidgetFormInputText(),
      'abuse_comment'        => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'requestor_id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('requestor_id')), 'empty_value' => $this->getObject()->get('requestor_id'), 'required' => false)),
      'requestee_id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('requestee_id')), 'empty_value' => $this->getObject()->get('requestee_id'), 'required' => false)),
      'friendship_status_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FriendshipStatuses'))),
      'abuse'                => new sfValidatorInteger(array('required' => false)),
      'abuse_comment'        => new sfValidatorString(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friendship_requests[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FriendshipRequests';
  }

}
