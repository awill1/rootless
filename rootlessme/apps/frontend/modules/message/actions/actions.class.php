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
    /**
     * Executes the index action
     * @param sfWebRequest $request The http request
     */
    public function executeIndex(sfWebRequest $request)
    {
        // Get the current user's messages
        $this->messages = Doctrine_Core::getTable('Messages')->getMyLastMessagesForConversationWithProfiles();
    }

    /**
     * Executes the list action
     * @param sfWebRequest $request The http request
     */
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

    /**
     * Executes the show action
     * @param sfWebRequest $request The http request
     */
    public function executeShow(sfWebRequest $request)
    {
        // Get the message
        $message = $this->getRoute()->getObject();
        $this->author = $message->getPeople()->getProfiles();

        // Get all messages in the conversation
        $this->conversation = $message->getConversations();
        $this->messages = Doctrine_Core::getTable('Messages')->getMyConversationMessagesWithProfiles($this->conversation->getConversationId());
        
        
        $this->participants = $this->conversation->getParticipants();
        
        //php loop
        //loop through all messages and mark them as read
        foreach ($this->messages as $currentMessage) {
            $currentMessage->markAsRead();
        }
        
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
        $this->replyForm = new ReplyForm($replyMessage);
        // Set the recipient to be the old author

        $this->forward404Unless($message);
    }

    /**
     * Executes the new action.
     * @param sfWebRequest $request The http request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new MessagesForm();
    }

    /**
     * Executes the create action
     * @param sfWebRequest $request The http request
     * @return String If the request was an ajax request, html is returned 
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
         
        $this->form = null;
        //gets type of message
        $messageType = $request->getParameter('messageType');
        if ($messageType=='new')
        {
            $this->form = new MessagesForm();
        }else{
            $this->form = new ReplyForm();
        }
        
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

            return $this->renderText('Message sucessfully sent.');
        }
        else
        {
            if (!$message)
            {
                // There was an error and so set the template to new and let the
                // form validators show.
                $this->setTemplate('new');
            }
            else
            {
                // Not an AJAX call so redirect to the show message page
                $this->redirect('messages_show',$message);
            }
        }
    }

    /**
     * Executes the delete action
     * @param sfWebRequest $request The http request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($message = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('message_id'),
                                $request->getParameter('conversation_id'))), sprintf('Object message does not exist (%s).', $request->getParameter('message_id'),
                                $request->getParameter('conversation_id')));
        $message->delete();

        $this->redirect('message/index');
    }

    /**
     * Gets a list of possible recipients.
     * @param sfWebRequest $request The http request
     */
    public function executePossibleRecipientList(sfWebRequest $request)
    {
        // Get all of the users for now
        $this->profiles = Doctrine_Core::getTable('Profiles')->getAll();
    }

    /**
     * Processes a message form.
     * @param sfWebRequest $request The http request
     * @param sfForm $form The form to save
     * @return Messages The message if it was created. Null if it was not created
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            // Save the message and get the resulting message id
            $message = $form->save();
            $messageId = $message->getMessageId();

            // Update the list of recipients
            if ($form->getValue('to'))
            {
                // Multiple recipients
                $recipientIds = $form->getValue('to');
            }
            else
            {
                $participants = $message->getConversations()->getParticipants();
                $authorId = $this->getUser()->getGuardUser()->getPeople()->getPersonId();
                $participantIds = array();
                foreach($participants as $participant)
                {
                    $recipientId = $participant->getPersonId();
                    if ($recipientId!=$authorId){
                        $recipientIds[] = $recipientId;
                    }
                     
                }
            }
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
            return $message;
        }
    }
}
