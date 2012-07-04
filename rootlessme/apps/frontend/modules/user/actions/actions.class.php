<?php

/**
 * user actions.
 *
 * @package    RootlessMe
 * @subpackage user
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
    /**
     * Processes the Facebook connect login response
     * Source http://www.scalablepath.com/blog/facebook-connect-with-symfony-1-x/167
     * @param sfWebRequest $request The web request
     * @return String nothing 
     */
    public function executeFacebookConnectLogin(sfWebRequest $request)
    {
        $this->logMessage('Entered executeFacebookConnectLogin', 'info');
        
        //Creating a new Facebook object from the Facebook PHP SDK
        require_once sfConfig::get('app_facebook_sdk_file');

        $facebook = new Facebook(array(
            'appId'  => sfConfig::get('app_facebook_app_id'),
            'secret' => sfConfig::get('app_facebook_secret'),
        ));

        //Get user object from Facebook - this method is only executed after we've confirmed that the user
        //has an active session with facebook and that our app is approved...so it should work
        $facebook_user = $facebook->getUser();

        if ($facebook_user)
        {
            try
            {
                // Proceed knowing you have a logged in user who's authenticated through facebook
                $access_token = $facebook->getAccessToken();

                //Grab the user's data from the facebook graph API using the fresh access token
                //we define which fields we want in app.yml ("id,first_name,last_name,picture,email,gender,friends")
                $requestUrl = 'https://graph.facebook.com/me?access_token='
                    .$access_token
                    .'&fields='.sfConfig::get('app_facebook_fields');  

                $response = @file_get_contents($requestUrl);

                //TODO: Down the road, try new method of getting info here:
                //http://developers.facebook.com/docs/reference/php/facebook-api/
                //$facebook_user_profile = $facebook->api('/me');      

                if($response)
                {
                    $facebook_user_profile = json_decode($response);

                    if(!is_null($facebook_user_profile->email)) //just to make sure we have the right data
                    {
                        //Check to see if user is already in our database
                        $user = Doctrine::getTable('sfGuardUser')->getUserByFacebookId($facebook_user_profile->id);

                        //If no, create a new user instance and populate with data from facebook
                        if(!$user)
                        {
                            $user = new sfGuardUser();

                            //This function saves the user's first name, last name, gender, email address,
                            //picture, and Facebook id
                            $user->setUserDataFromFacebook($facebook_user_profile);

                            //Save the fresh access token to the DB for later use
                            //$user->setFbAccessToken($access_token);

                            //Save new user data to database
                            $user->save();
                            
                            // Update the profile information too
                            $profile = $user->getPeople()->getProfiles();
                            $profile->setUserDataFromFacebook($facebook_user_profile);
                            $profile->save();

                        }else
                        {
                            // User is already in the system.
                            // Update the profile information based on facebook settings.
                            // Is this desired?
                            $profile = $user->getPeople()->getProfiles();
                            $profile->setUserDataFromFacebook($facebook_user_profile);
                            $profile->save();
//
//                            $user->setProfilePicture($facebook_user_profile->picture);
//                            $user->setFbAccessToken($access_token);
//                            $user->save();
                        }

                        //Finally, log the user in using sfGuard method
                        if($user)
                        {
                            if (!$this->getUser()->isAuthenticated())
                            {
                                //Second parameter activates the remember me cookie when set to true
                                $this->getUser()->signIn($user, true);
                            }
                        }
                    }
                }
            }
            catch (FacebookApiException $e)
            {
                error_log($e);
                $facebook_user = null;
            }
        }

        //This is all done via AJAX, so no html is rendered
        return sfView::NONE;
    }
}
