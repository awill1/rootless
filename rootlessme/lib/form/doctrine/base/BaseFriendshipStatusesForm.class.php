<?php

/**
 * FriendshipStatuses form base class.
 *
 * @method FriendshipStatuses getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriendshipStatusesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'friendship_status_id' => new sfWidgetFormInputHidden(),
      'display_text'         => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'friendship_status_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('friendship_status_id')), 'empty_value' => $this->getObject()->get('friendship_status_id'), 'required' => false)),
      'display_text'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('friendship_statuses[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FriendshipStatuses';
  }

}
