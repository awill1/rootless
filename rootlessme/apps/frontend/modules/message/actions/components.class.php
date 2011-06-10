<?php

class messageComponents extends sfComponents
{
    public function executeMessageMenu(sfWebRequest $request)
    {
        // Get the new messages for the user
        $this->newMessages = Doctrine_Core::getTable('Messages')->getMyNewMessages();
    }
}
