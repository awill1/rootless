<?php

/**
 * Description of userNotification
 *
 * @author awilliams
 */
abstract class userNotification {
    
    protected $replacementVariables;
    public function getReplacementVariables()
    {
        return $this->replacementVariables;
    }
    public function setReplacementVariables($replacementVariables)
    {
        $this->replacementVariables = $replacementVariables;
    }
    
    abstract protected function getMessageTemplate();
    abstract protected function getSubjectTemplate();


    public function getMessage()
    {
        return $this->replaceVariablesInMessage($this->getReplacementVariables(),
                                                $this->getMessageTemplate());
    }
    
    public function getSubject()
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
