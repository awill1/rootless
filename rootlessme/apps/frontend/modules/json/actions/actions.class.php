<?php

/**
 * json actions.
 *
 * @package    RootlessMe
 * @subpackage json
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jsonActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
      
    /**
     * Executes show action
     *
     * @param sfRequest $request A request object
     */
    public function executeShow(sfWebRequest $request)
    {
        // Get the ride type and ride id
        $this->rideType = $request->getParameter('ride_type');
        $this->rideId = $request->getParameter('ride_id');

        // Create the appropriate type of form
        switch ($this->rideType) {
            case "offer":
                $this->partial = 'showOffer';
                break;
            case "request":
                $this->partial = 'showRequest';
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
    }
}
