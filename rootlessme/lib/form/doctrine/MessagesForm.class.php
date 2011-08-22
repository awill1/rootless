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
//      $this->setWidget('to', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)));
      // Allow multiple recipients
      $this->setWidget('to', new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('People'),
          'add_empty' => false,
          'multiple' => true
        )));

      // Add the conversation widget as a hidden text field
      $this->setWidget('conversation_id', new sfWidgetFormInputHidden());

      // Set up the new validators
//      $this->setValidator('to', new sfValidatorString(array('required' => true)));
      $this->setValidator('to', new sfValidatorDoctrineChoice(array(
          'model' => $this->getRelatedModelName('People'),
          'multiple' => true
      )));

      // Choose the fields that will be displayed
      unset($this['created_at']);
      unset($this['updated_at']);
      $this->useFields(array(
          'conversation_id',
          'to',
          'subject',
          'body' ));
  }

    public function doSave($con = null) {
        $message = $this->getObject();
        //if (!$message->getConversationId())

        // The author should be the author who is logged in
        $this->values['author_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();

        if (!$this->values['conversation_id'])
        {
            // This is a new conversation so create the new conversation
            $newConversation = new Conversations();
            // Set the author
            $newConversation->setAuthorId($this->values['author_id']);
            // Set the subject
            $newConversation->setSubject($this->values['subject']);
            // Save the conversation
            $newConversation->save();

            // Set the message to use the new conversation
            //$message->setConversationId($newConversation->getConversationId());
            $this->values['conversation_id'] = $newConversation->getConversationId();
        }

        // Call the parent function to save the message
         return parent::doSave($con);
    }
}
