<?php

/**
 * message actions.
 *
 * @package    RootlessMe
 * @subpackage message
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class messageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      // Get the current user's messages
      //$this->messages = Doctrine_Core::getTable('Messages')->getMyMessages();
      $this->messages = Doctrine_Core::getTable('Messages')->getMyLastMessagesForConversationWithProfiles();
  }

    public function executeList(sfWebRequest $request)
    {
        // Get the message list type
        $this->listType = $request->getParameter('list_type');

        // Get the messages based on the  the appropriate type of form
        switch ($this->listType) {
            case "inbox":
                // Get the current user's messages
                $this->messages = Doctrine_Core::getTable('Messages')->getMyLastMessagesForConversationWithProfiles();
                break;
            case "sent":
                // Get the current user's sent messages
                $this->messages = Doctrine_Core::getTable('Messages')->getMySentMessages();
                break;
            case "trash":
                // This is
                //$this->messages = null;
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'List Type '.$this->rideType.'is invalid.';
        }
      
    }

  public function executeShow(sfWebRequest $request)
  {
      // Get the message
      $message = $this->getRoute()->getObject();
      $this->author = $message->getPeople()->getProfiles();

      // Get all messages in the conversation
      $this->conversation = $message->getConversations();
      $this->messages = Doctrine_Core::getTable('Messages')->getMyConversationMessagesWithProfiles($this->conversation->getConversationId());

      // Create the reply form
      $replyMessage = new Messages();
      // Set the known reply features
      //$replyMessage->setPeople($this->getUser()->getGuardUser()->getPeople());
      $replyMessage->setSubject($this->conversation->getSubject());
      $replyMessage->setConversationId($this->conversation->getConversationId());
      // Set the recipient to be the original author
      //$replyRecipient = new MessageRecipients();
      //$replyRecipient->setPeople($this->message->getPeople());
      // Link the message and the recipient together
      //$replyRecipient->setMessages($replyMessage);
      // Add the reply message to the reply form
      $this->replyForm = new MessagesForm($replyMessage);
      // Set the recipient to be the old author

      $this->forward404Unless($message);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MessagesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MessagesForm();

    $message = $this->processForm($request, $this->form);

    $this->setTemplate('new');
    
    // Different behaviors depending on whether it is an AJAX request
    if ($request->isXmlHttpRequest())
    {
        // This is an ajax request so return the new object
        if (!$message)
        {
            return $this->renderText('Message was not sent.');
        }

        //return $this->renderPartial('review/reviewListItem', array('review' => $review));
        return $this->renderText('Message sucessfully sent.');
    }
    else
    {
        // Not an AJAX call so redirect to the show message page
        $this->redirect('messages_show',$message);
    }
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($message = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('message_id'),
                            $request->getParameter('conversation_id'))), sprintf('Object message does not exist (%s).', $request->getParameter('message_id'),
                            $request->getParameter('conversation_id')));
    $this->form = new MessagesForm($message);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($message = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('message_id'),
                            $request->getParameter('conversation_id'))), sprintf('Object message does not exist (%s).', $request->getParameter('message_id'),
                            $request->getParameter('conversation_id')));
    $this->form = new MessagesForm($message);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($message = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('message_id'),
                            $request->getParameter('conversation_id'))), sprintf('Object message does not exist (%s).', $request->getParameter('message_id'),
                            $request->getParameter('conversation_id')));
    $message->delete();

    $this->redirect('message/index');
  }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            // Save the message and get the resulting message id
            $message = $form->save();
            $messageId = $message->getMessageId();

            // Update the list of recipients

            // Multiple recipients
            $recipientIds = $form->getValue('to');
            $addedRecipientIds = array();
            foreach ($recipientIds as $recipientId)
            {
                // Skip the recipient if they have already been added as a
                // recipient
                if (!in_array( $recipientId , $addedRecipientIds ))
                {
                    // Create a recipient using the recipient id
                    $recipient = new MessageRecipients();
                    $recipient->setPersonId($recipientId);
                    // Link the recipient to the message
                    $recipient->setMessageId($messageId);
                    // Save the recipient
                    $recipient->save();

                    // Add the recipient to the added recipient list to
                    // prevent duplicate messages
                    $addedRecipientIds[] = $recipientId;
                }
            }
        }

        return $message;
    }
}
