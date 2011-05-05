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
        $this->carpools = Doctrine_Core::getTable('Carpools')
             ->getWithProfiles();
        $this->passengers = Doctrine_Core::getTable('Passengers')
             ->getWithProfiles();
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

    /**
    * Executes new offer action
    *
    * @param sfRequest $request A request object
    */
    public function executeNewOffer(sfWebRequest $request)
    {
        $this->form = new CarpoolsForm();
    }

      public function executeCreateOffer(sfWebRequest $request)
      {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CarpoolsForm();

        $this->processFormOffer($request, $this->form);

        $this->setTemplate('newOffer');
      }
      
      public function executeEditOffer(sfWebRequest $request)
      {
        $this->forward404Unless($carpool = Doctrine_Core::getTable('Carpools')->find(array($request->getParameter('carpool_id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('carpool_id')));
        $this->form = new CarpoolsForm($carpool);
      }

      public function executeUpdateOffer(sfWebRequest $request)
      {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($carpool = Doctrine_Core::getTable('Carpools')->find(array($request->getParameter('carpool_id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('carpool_id')));
        $this->form = new CarpoolsForm($carpool);

        $this->processForm($request, $this->form);

        $this->setTemplate('editOffer');
      }

      public function executeDeleteOffer(sfWebRequest $request)
      {
        $request->checkCSRFProtection();

        $this->forward404Unless($carpool = Doctrine_Core::getTable('Carpools')->find(array($request->getParameter('carpool_id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('carpool_id')));
        $carpool->delete();

        $this->redirect('rides/offers');
      }

      protected function processFormOffer(sfWebRequest $request, sfForm $form)
      {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            // Handle the route from the javascript
//            $this->logMessage('The value of carpools_route follows:', 'debug');
//            $this->logMessage($form->getValue('route'), 'debug');
//            $jRoute = json_decode($form->getValue('route_route_data'), true);
//            $this->logMessage("JSON last error: ".json_last_error(), 'debug');
//            $this->logMessage("Object: ".$jRoute, 'debug');
//            $this->logMessage("Status: ".$jRoute["status"], 'debug');
//            $routeNumber = 0;
//            $this->logMessage("Summary: ".$jRoute["routes"][$routeNumber]["summary"], 'debug');
//            $this->logMessage("Copyright: ".$jRoute["routes"][$routeNumber]["copyrights"], 'debug');
//            $copyright = $jRoute["routes"][$routeNumber]["copyrights"];
//            $summary = $jRoute["routes"][$routeNumber]["summary"];
//            //$warnings = $jRoute["routes"][$routeNumber]["warnings"];
//            $polyline = $jRoute["routes"][$routeNumber]["overview_polyline"]["points"];
//            $routeToSave = new Routes();
//            $routeToSave->setCopyright($copyright);
//            $routeToSave->setSummary($summary);
//            //$routeToSave->setWarning($warnings);
//            $routeToSave->setEncodedPolyline($polyline);
//
//            $savedRoute = $routeToSave->save();
//
//            //$this->routeID = $routeToSave->getRouteId();
//            $form->routeId = $routeToSave->getRouteId();

            // Save the form
            $carpool = $form->save();
          

            $this->redirect('ride_offer',$carpool);
         // $this->redirect('rides/offers/edit?carpool_id='.$carpool->getCarpoolId());
        }
      }
}
