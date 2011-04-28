<?php

/**
 * ride actions.
 *
 * @package    RootlessMe
 * @subpackage ride
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rideActions extends sfActions
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
  * Executes show offer action
  *
  * @param sfRequest $request A request object
  */
  public function executeShowOffer(sfWebRequest $request)
  {
    //$this->carpool = Doctrine_Core::getTable('Carpools')->find(array($request->getParameter('carpool_id')));
    $this->carpool = $this->getRoute()->getObject();
    $this->carpoolRoute = $this->carpool->getRoutes();
    $this->origin = $this->carpool->getOriginLocation();
    $this->destination = $this->carpool->getDestinationLocation();
    $this->driver = $this->carpool->getPeople()->getProfiles()->getFirst();
    $this->forward404Unless($this->carpool);
  }
}
