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
      $this->messages = Doctrine_Core::getTable('Messages')->getMyMessages();
  }

  public function executeShow(sfWebRequest $request)
  {
      // Get the message
      $this->message = $this->getRoute()->getObject();
      $this->author = $this->message->getPeople()->getProfiles()->getFirst();

      // Create the reply form
      $replyMessage = new Messages();
      // Set the known reply features
      //$replyMessage->setPeople($this->getUser()->getGuardUser()->getPeople());
      $replyMessage->setSubject('re: '.$this->message->getSubject());
      $replyMessage->setConversationId($this->message->getConversationId());
      // Set the recipient to be the original author
      //$replyRecipient = new MessageRecipients();
      //$replyRecipient->setPeople($this->message->getPeople());
      // Link the message and the recipient together
      //$replyRecipient->setMessages($replyMessage);
      // Add the reply message to the reply form
      $this->replyForm = new MessagesForm($replyMessage);
      // Set the recipient to be the old author

      $this->forward404Unless($this->message);
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
      $message = $form->save();

      // Update the list of recipients
      // Just one recipient for now
      $recipient = new MessageRecipients();
      $recipient->setMessageId($message->getMessageId());
      $recipient->setPersonId($form->getValue('to'));
      $recipient->save();

      //$this->redirect('message/edit?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId());
    }

    return $message;
  }
}
