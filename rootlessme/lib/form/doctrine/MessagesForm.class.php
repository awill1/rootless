<?php

/**
 * Messages form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MessagesForm extends BaseMessagesForm
{
  public function configure()
  {
      // Add the facebook like field for recipients
//      $this->setWidget('to', new sfWidgetFormInputText());
      // For now just allow 1 recipient
      $this->setWidget('to', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)));

      // Set up the new validators
//      $this->setValidator('to', new sfValidatorString(array('required' => true)));
      $this->setValidator('to', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('People'))));

      // Choose the fields that will be displayed
      unset($this['created_at']);
      unset($this['updated_at']);
      $this->useFields(array(
          'conversation_id',
          'author_id',
          'to',
          'subject',
          'body' ));
  }
}
