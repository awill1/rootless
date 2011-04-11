<?php

/**
 * Tags form base class.
 *
 * @method Tags getObject() Returns the current form's model object
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTagsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtags' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'idtags' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtags')), 'empty_value' => $this->getObject()->get('idtags'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

}
