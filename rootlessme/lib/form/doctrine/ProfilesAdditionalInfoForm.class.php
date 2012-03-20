<?php

/**
 * Profiles additional information form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfilesAdditionalInfoForm extends ProfilesForm
{
    public function configure()
    {
        // Use the parent configuration function
        parent::configure();
        
        // Unset most fields because the additional info form only contains:
        // - About Me

        unset($this['profile_name']);
        unset($this['first_name']);
       unset($this['last_name']);
        unset($this['picture_url']);
        unset($this['picture_url_large']);
        unset($this['picture_url_medium']);
        unset($this['picture_url_small']);
        unset($this['picture_url_tiny']);
        unset($this['address1']);
       unset($this['address2']);
        unset($this['city']);
        unset($this['state']);
        unset($this['postal_code']);
        unset($this['country']);
        unset($this['phone_number']);
        unset($this['birthday']);
        unset($this['gender']);
//        unset($this['about_me']);
//        unset($this['top5']);
//        unset($this['wants_to_travel_to']);
//        unset($this['music']);
//       unset($this['movies']);
//        unset($this['books']);
//        unset($this['interests']);
//        unset($this['favorite_websites']);
        unset($this['website_url']);
        unset($this['facebook_user_name']);
        unset($this['twitter_user_name']);
        unset($this['person_id']);
        unset($this['created_at']);
        unset($this['updated_at']);
    }

    /**
     * Overrides the default is multipart function. 
     * @return bool Always returns false. 
     */
    public function isMultipart()
    {
        return false;
    }
}
