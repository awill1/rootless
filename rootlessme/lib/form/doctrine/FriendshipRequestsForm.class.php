<?php

/**
 * FriendshipRequests form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FriendshipRequestsForm extends BaseFriendshipRequestsForm
{
  public function configure()
  {
        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
  }
}
