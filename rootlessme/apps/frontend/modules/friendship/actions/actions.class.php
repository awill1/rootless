<?php

/**
 * friendship actions.
 *
 * @package    RootlessMe
 * @subpackage friendship
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class friendshipActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->friendships = Doctrine_Core::getTable('Friendships')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->friendship = Doctrine_Core::getTable('Friendships')->find(array($request->getParameter('friend1_id'),
                                            $request->getParameter('friend2_id')));
    $this->forward404Unless($this->friendship);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FriendshipsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FriendshipsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($friendship = Doctrine_Core::getTable('Friendships')->find(array($request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id'))), sprintf('Object friendship does not exist (%s).', $request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id')));
    $this->form = new FriendshipsForm($friendship);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($friendship = Doctrine_Core::getTable('Friendships')->find(array($request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id'))), sprintf('Object friendship does not exist (%s).', $request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id')));
    $this->form = new FriendshipsForm($friendship);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($friendship = Doctrine_Core::getTable('Friendships')->find(array($request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id'))), sprintf('Object friendship does not exist (%s).', $request->getParameter('friend1_id'),
                      $request->getParameter('friend2_id')));
    $friendship->delete();

    $this->redirect('friendship/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $friendship = $form->save();

      $this->redirect('friendship/edit?friend1_id='.$friendship->getFriend1Id().'&friend2_id='.$friendship->getFriend2Id());
    }
  }

  // Friend request actions
  public function executeNewFriendshipRequest(sfWebRequest $request)
  {
    $this->form = new FriendshipRequestsForm();
  }

    public function executeCreateFriendshipRequest(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new FriendshipRequestsForm();

        // Set the friend request status to pending
        $this->values[status] = $this->friendships = Doctrine_Core::getTable('Friendships')->find();

        $friendRequest = $this->processFriendRequestForm($request, $this->form);

        $this->setTemplate('new');

        if ($request->isXmlHttpRequest())
        {
            // This is an ajax request so return the new object
            if (!$friendRequest)
            {
                return $this->renderText('No new item.');
            }
            return 'Friendship resquest sent.';
        }
        else
        {
            // Not an AJAX call so redirect to the new friend page
            $this->redirect('friendship_request_show', array('friend1_id'=>$friendRequest->getFriend1Id(),'friend2_id'=>$friendRequest->getFriend2Id()));
        }
    }

    protected function processFriendRequestForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $friendshipRequest = $form->save();
        }
        return $friendshipRequest;
    }
}
