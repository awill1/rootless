<?php
/**
 * Security helper functions used throughout the website
 *
 * @author awilliams
 */
class SecurityHelpers {

    /**
     * Checks to see if the user is a rootless admin
     * @return Boolean True, if the user is a rootless admin. False, otherwise.
     */
    public static function IsRootlessAdmin($username) {
        $isAdmin = false;
        
        // Get the rootless admin list from app.yml
        $rootlessAdminList = sfConfig::get('app_rootless_admins');
        $rootlessAdmins = explode(",", $rootlessAdminList);
        
        // See if the user is in the admin list
        foreach ($rootlessAdmins as $admin) 
        {
            if (strtolower($admin) == strtolower($username))
            {
                $isAdmin = true;
            }
        }
        
        return $isAdmin;
    }
}

?>
