<?php

/**
 * Friendships form base class.
 *
 * @method Friendships getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriendshipsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'travelers_idusers'  => new sfWidgetFormInputHidden(),
      'travelers_idusers1' => new sfWidgetFormInputHidden(),
      'pending'            => new sfWidgetFormInputText(),
      'initiatedby'        => new sfWidgetFormInputText(),
      'createdon'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'travelers_idusers'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('travelers_idusers')), 'empty_value' => $this->getObject()->get('travelers_idusers'), 'required' => false)),
      'travelers_idusers1' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('travelers_idusers1')), 'empty_value' => $this->getObject()->get('travelers_idusers1'), 'required' => false)),
      'pending'            => new sfValidatorInteger(array('required' => false)),
      'initiatedby'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'createdon'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
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
