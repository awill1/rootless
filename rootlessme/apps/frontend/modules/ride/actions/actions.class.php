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
        $this->searchForm = new RideSearchForm();
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
        
        // If the ride failed return to the new page
        if ($ride == null)
        {
            // Create the appropriate type of form
            switch ($this->rideType) 
            {
                case "offer":
                    $this->partial = 'rideOfferForm';
                    break;
                case "request":
                    $this->partial = 'rideRequestForm';
                    break;
            }
            $this->setTemplate('new');
        }
        else
        {
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
    }
    
    /**
     * Executes edit action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request)
    {
        // Get the input parameters
        $this->rideType = $request->getParameter('ride_type');
        $this->rideId = $request->getParameter('ride_id');

        // Create the appropriate type of form with the ride
        switch ($this->rideType) {
            case "offer":
                // Get the seat information
                $this->ride = Doctrine_Core::getTable('Carpools')->find($this->rideId);
                $this->forward404Unless($this->ride);
                $this->form = new CarpoolsForm($this->ride);
                $this->partial = 'rideOfferForm';
                break;
            case "request":
                $this->ride = Doctrine_Core::getTable('Passengers')->find($this->rideId);
                $this->forward404Unless($this->ride);
                $this->form = new PassengersForm($this->ride);
                $this->partial = 'rideRequestForm';
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
    }
    
    /**
     * Executes update action
     *
     * @param sfRequest $request A request object
     */
    public function executeUpdate(sfWebRequest $request)
    {
        // Get the input parameters
        $this->rideType = $request->getParameter('ride_type');
        $this->rideId = $request->getParameter('ride_id');

        $this->form = NULL;
        // Create the appropriate type of form with the ride
        switch ($this->rideType) {
            case "offer":
                // Get the seat information
                $this->ride = Doctrine_Core::getTable('Carpools')->find($this->rideId);
                $this->forward404Unless($this->ride);
                $this->form = new CarpoolsForm($this->ride);
                break;
            case "request":
                $this->ride = Doctrine_Core::getTable('Passengers')->find($this->rideId);
                $this->forward404Unless($this->ride);
                $this->form = new PassengersForm($this->ride);
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               $this->forward404('Ride Type '.$this->rideType.'is invalid.');
        }
                
        $this->processForm($request, $this->form);
        
        // Return the thing.
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

    /**
     * Executes the delete action
     * @param sfWebRequest $request The web request.
     * @return type Html to display afterwards.
     */
    public function executeDelete(sfWebRequest $request)
    {
        // Make sure this is a post request
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        
        // Get the ride type and ride id
        $this->rideType = $request->getParameter('ride_type');
        $this->rideId = $request->getParameter('ride_id');

        // Only authenticated users can use this action
        if ($this->getUser()->isAuthenticated())
        {
            $userId = $this->getUser()->getGuardUser()->getPersonId();
        
            // Get the correct ride
            $ride = null;
            switch ($this->rideType) {
                case "offer":
                    $ride = Doctrine_Core::getTable('Carpools')->find($this->rideId);
                    break;
                case "request":
                    $ride = Doctrine_Core::getTable('Passengers')->find($this->rideId);
                    break;
                default:
                   // Default case just in case the ride_type is invalid (should
                   // be prevented by routing.yml).
                   $errorMessage =  'Ride Type '.$this->rideType.'is invalid.';
                   $this->logMessage($errorMessage, 'err');
            }

            // Set the status to deleted
            if (!is_null($ride))
            {
                if ($ride->isMyRide($userId))
                {
                    $ride->setStatusId(RideStatuses::$statuses[RideStatuses::RIDE_DELETED]);
                    $ride->save();
                    
                    // If the request came from AJAX render the seat negotiation history
                    // partial with the updated seat information
                    if ($request->isXmlHttpRequest())
                    {
                        return $this->renderText('Ride was deleted.');
                    }
                    else
                    {
                        // This was not an ajax request redirect to the dashboard
                        $this->getUser()->setFlash('notice', 'Ride was deleted.');
                        $this->forward('dashboard', 'index');
                    }
                }
            }
        }
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
