<?php

/**
 * conversation actions.
 *
 * @package    RootlessMe
 * @subpackage conversation
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conversationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->conversations = Doctrine_Core::getTable('Conversations')
            ->createQuery('a')
            ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->conversation = $this->getRoute()->getObject();
        $this->messages = $this->conversation->getActiveMessages();
    }

}
