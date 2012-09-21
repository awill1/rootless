<?php

/**
 * Description of userNotification
 *
 * @author awilliams
 */
abstract class userNotification {
    
    protected $replacementVariables;
    protected $test;
    public function getReplacementVariables()
    {
        return $this->replacementVariables;
    }
    public function setReplacementVariables($replacementVariables)
    {
        $this->replacementVariables = $replacementVariables;
    }
    
    public function sendNotifications()
    {
        // Get the 
    }


    abstract protected function getEmailMessageTemplate();
    abstract protected function getEmailSubjectTemplate();


    public function getEmailMessage()
    {
        return $this->replaceVariablesInMessage($this->getReplacementVariables(),
                                                $this->getMessageTemplate());
    }
    
    public function getEmailSubject()
    {
        return $this->replaceVariablesInMessage($this->getReplacementVariables(),
                                                $this->getSubjectTemplate());
    }
    
    protected static function replaceVariablesInMessage($replacementVariables, $message)
    {
        // Foreach replacement variable, replace it in the message
        foreach ($replacementVariables as $token => $replacement) {
            $message = str_replace($token, $replacement, $message);
        }
                
        return $message;
    }

}

?>
