<?php

/**
 * special actions.
 *
 * @package    RootlessMe
 * @subpackage special
 * @author     rwells
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class specialActions extends sfActions
{
    /**
     * Executes patriots action
     *
     * @param sfRequest $request A request object
     */
    public function executePatriots(sfWebRequest $request)
    {

    }
  
    /**
     * Executes special events register action
     *
     * @param sfRequest $request A request object
     */
    public function executeRegister(sfWebRequest $request)
    {
        // Load the AWS SDK
        require_once sfConfig::get('app_amazon_sdk_file');
        
        // Verify the request parameters
        $email = $request->getParameter('email');
        $game = $request->getParameter('game');
        $location = $request->getParameter('location');
        $name = $request->getParameter('name');
        $seats = $request->getParameter('seats');
        $userType = $request->getParameter('userType');
        
        // Send the notification using Amazon SNS  
        $snsService = new AmazonSNS(array('key' => sfConfig::get('app_amazon_sns_access_key'), 
                                          'secret' => sfConfig::get('app_amazon_sns_secret_key')));
        $messageTemplate = 
            "New Special event request.
            UserType: %userType%
            Name: %name%
            Email: %email%
            Game: %game%
            Location: %location%
            Seats: %seats%";
        $formattedMessage = strtr($messageTemplate, array(
            '%userType%'  => $userType,
            '%name%'      => $name,
            '%email%'     => $email,
            '%game%'      => $game,
            '%location%'  => $location,
            '%seats%'     => $seats
        ));
        $subjectTemplate = "%email% has registered for %game%";
        $formattedSubject = strtr($subjectTemplate, array(
            '%email%'     => $email,
            '%game%'      => $game
        ));
        $snsService->publish(sfConfig::get('app_amazon_sns_access_key'), 
                $formattedMessage, 
                array('Subject' => $formattedSubject));
        
        // Return nothing to the page 
        $this->setLayout(sfView::NONE);
        return $this->renderText("{ success: true }");
    }
}
