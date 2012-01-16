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
        // NOTE FOR LATER...
        // Need to query both the Carpools and Passengers table together
        // With a query that looks a little like this
        // SELECT p.passenger_id AS pk, 'request' AS rideType, p.person_id AS person_id, p.start_date AS start_date, p.start_time AS start_time, p.asking_price AS asking_price FROM passengers p
        // UNION ALL
        // SELECT c.carpool_id AS pk, 'offer' AS rideType, c.driver_id AS person_id, c.start_date AS start_date, c.start_time AS start_time, c.asking_price AS asking_price FROM carpools c
        // ORDER BY start_date, start_time;
        // Need to add the query at the appropriate place in the model.

        $this->searchForm = new RideSearchForm();
        $this->carpools = Doctrine_Core::getTable('Carpools')
             ->getWithProfiles();
        $this->passengers = Doctrine_Core::getTable('Passengers')
             ->getWithProfiles();

    }

    /**
    * Executes search action
    *
    * @param sfRequest $request A request object
    */
    public function executeSearch(sfWebRequest $request)
    {
        // Get the request parameters
        $ride_parameters = $this->getRequestParameter('rides');
        $searchDate = $ride_parameters['date'];
        
        // Get the search parameters
        $myStartLatitude = $ride_parameters['origin_latitude'];
        $myStartLongitude = $ride_parameters['origin_longitude'];
        $myEndLatitude = $ride_parameters['destination_latitude'];
        $myEndLongitude = $ride_parameters['destination_longitude'];
        // Use the application default distance setting
        $myDistance = sfConfig::get('app_default_search_distance');

        $this->carpools = Doctrine_Core::getTable('Carpools')
             ->getNearPoints($myDistance, $myStartLatitude, $myStartLongitude, $myEndLatitude, $myEndLongitude, $searchDate);
        $this->passengers = Doctrine_Core::getTable('Passengers')
             ->getNearPoints($myDistance, $myStartLatitude, $myStartLongitude, $myEndLatitude, $myEndLongitude, $searchDate);
        
        if ($request->isXmlHttpRequest())
        {
            // This is an ajax request
            //if ('*' == $query || !$this->carpools)
            if (!$this->carpools)
            {
              return $this->renderText('No results.');
            }

            return $this->renderPartial('ride/ridesList', array('carpools' => $this->carpools, 'passengers' => $this->passengers));
        }
        else
        {
            // This is not an ajax request
            //return $this->renderPartial('ride/ridesList', array('carpools' => $this->carpools, 'passengers' => $this->passengers));
        }

    }

    /**
     * Executes new action
     *
     * @param sfRequest $request A request object
     */
    public function executeNew(sfWebRequest $request)
    {
        // Get the ride type
        $this->rideType = $request->getParameter('ride_type');

        // Create the appropriate type of form
        switch ($this->rideType) {
            case "offer":
                $this->form = new CarpoolsForm();
                $this->partial = 'rideOfferForm';
                break;
            case "request":
                $this->form = new PassengersForm();
                $this->partial = 'rideRequestForm';
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
    }

    /**
    * Executes the create action
    *
    * @param sfRequest $request A request object
    */
    public function executeCreate(sfWebRequest $request)
    {
        // Make sure this is a post request
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        
        // Get the ride type
        $this->rideType = $request->getParameter('ride_type');
        
        // Create the appropriate type of form
        switch ($this->rideType) {
            case "offer":
                $this->form = new CarpoolsForm();
                break;
            case "request":
                $this->form = new PassengersForm();
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.' is invalid.';
        }
        
        // Process the form
        $ride = $this->processForm($request, $this->form);

        switch ($this->rideType) {
            case "offer":
                $ride_id = $ride->getCarpoolId();
                break;
            case "request":
                $ride_id = $ride->getPassengerId();
                break;
        }

        // Redirect to the page that will show the newly created ride
        $this->redirect('ride_show', array('ride_type'=>$this->rideType, 'ride_id'=>$ride_id));
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

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            // Save the form and return the resulting object
            $ride = $form->save();
            return $ride;
        }
    }
}
