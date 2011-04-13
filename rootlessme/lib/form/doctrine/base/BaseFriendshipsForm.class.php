<?php

/**
 * Friendships form base class.
 *
 * @method Friendships getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriendshipsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'friend_1_id' => new sfWidgetFormInputHidden(),
      'friend_2_id' => new sfWidgetFormInputHidden(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'friend_1_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('friend_1_id')), 'empty_value' => $this->getObject()->get('friend_1_id'), 'required' => false)),
      'friend_2_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('friend_2_id')), 'empty_value' => $this->getObject()->get('friend_2_id'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friendships[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friendships';
  }

}
