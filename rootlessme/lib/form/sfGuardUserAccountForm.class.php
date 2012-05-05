<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     awilliams, Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAccountForm extends BasesfGuardUserAdminForm
{
    /**
    * @see sfForm
    */
    public function configure()
    {
        // Unset the unused fields
        unset(
            $this['email_address'],
            $this['person_id'],
            $this['first_name'],
            $this['last_name'],
            $this['username'],
            $this['is_active'],
            $this['is_super_admin'],
            $this['groups_list'],
            $this['permissions_list']
        );
        
        // Make the password required
        $this->validatorSchema['password']->setOption('required', true);
    }
}
