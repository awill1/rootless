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
//    $this->messages = Doctrine_Core::getTable('Messages')
//      ->createQuery('a')
//      ->execute();
//
      // Get the current user's messages
      $this->messages = Doctrine_Core::getTable('Messages')->getMyMessages();
  }

  public function executeShow(sfWebRequest $request)
  {
    //$this->message = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('message_id'), $request->getParameter('conversation_id')));
    $this->messages = Doctrine_Core::getTable('Messages')->find(array($request->getParameter('conversation_id')));

    $this->forward404Unless($this->messages);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MessagesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MessagesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
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

      $this->redirect('message/edit?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId());
    }
  }
}
