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
        $myPolyline = $ride_parameters['polyline'];
        // Use the application default distance setting
        $myDistance = sfConfig::get('app_default_search_distance');

        // Get the list of driver matches
        $this->carpools = Doctrine_Core::getTable('Carpools')
             ->getNearPoints($myDistance, $myStartLatitude, $myStartLongitude, $myEndLatitude, $myEndLongitude, $searchDate);
        
        // Get the list of passenger matches
        $this->passengers = null;
        if (CommonHelpers::IsNullOrEmptyString($myPolyline))
        {
            // The origin and destination points were not both specified, so do
            // a search near the point specified
            $this->passengers = Doctrine_Core::getTable('Passengers')
                 ->getNearPoints($myDistance, $myStartLatitude, $myStartLongitude, $myEndLatitude, $myEndLongitude, $searchDate);
        }
        else
        {
            // The origin and destination points were both specified, so 
            // search along the route
            $this->passengers = Doctrine_Core::getTable('Passengers')
                 ->getAlongRoute($myDistance, $myPolyline, $searchDate);
        }
        
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
                    // Do the recommendations
                    $searchRadius = sfConfig::get('app_default_search_distance');
                    $ride->recommendPassengers($searchRadius);
                    break;
                case "request":
                    $ride_id = $ride->getPassengerId();
                    // Do the recommendations
                    $searchRadius = sfConfig::get('app_default_search_distance');
                    $ride->recommendDrivers($searchRadius);       
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
          
        // Save the ride
        $ride = $this->processForm($request, $this->form);
        
        // If the request came from AJAX render the seat negotiation history
        // partial with the updated seat information
        if ($request->isXmlHttpRequest())
        {
            if ($ride != null)
            {
            }
            else
            {
                return $this->renderText('Ride was not updated');
            }
        }
        else
        {
            $this->setTemplate('edit');

            if ($ride != null)
            {
                // This is not an AJAX request so redirect to the show ride
                // page
                $this->redirect('ride_show', array('ride_type' =>$this->rideType , 'ride_id' => $ride->getRideId()));
            }
        }
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
     * @return String Html to display afterwards.
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
    
    /**
     * Executes close action
     *
     * @param sfRequest $request A request object
     */
    public function executeClose(sfWebRequest $request)
    {
        // Get the input parameters
        $this->rideType = $request->getParameter('ride_type');
        $this->rideId = $request->getParameter('ride_id');
        $hash = $request->getParameter('hash');
        
        $this->forward404Unless($hash);
        
        //Success variable
        $this->setLayout(sfView::NONE);
        $success = 'false';

        // Create the appropriate type of form with the ride
        switch ($this->rideType) {
            case "offer":
                // Get the seat information
                $this->ride = Doctrine_Core::getTable('Carpools')->find($this->rideId);
                // Add a tiny bit of security with a hash in the close url since 
                // the user does not need to be logged in.
                // Get the owner id address for the post
                $ownerId = $this->ride->getDriverId();
                $actualHash = sha1($ownerId);
                $this->forward404Unless($hash == $actualHash);
                $this->ride->setStatusId(RideStatuses::$statuses[RideStatuses::RIDE_CLOSED]);
                $this->ride->save();
                $this->forward404Unless($this->ride);
                break;
            case "request":
                $this->ride = Doctrine_Core::getTable('Passengers')->find($this->rideId);
                // Add a tiny bit of security with a hash in the close url since 
                // the user does not need to be logged in.
                // Get the owner id address for the post
                $ownerId = $this->ride->getPersonId();
                $actualHash = sha1($ownerId);
                $this->forward404Unless($hash == $actualHash);
                $this->ride->setStatusId(RideStatuses::$statuses[RideStatuses::RIDE_CLOSED]);
                $this->ride->save();
                $this->forward404Unless($this->ride);
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
        
        // Set a flash and move to the show ride page
        $this->getUser()->setFlash( 'message', 'Some message here' );
        $this->forward('ride', 'show', array('ride_id'=> $this->rideId, 'ride_type' => $this->rideType));
    }
    
//    /**
//     * Executes create to place action
//     *
//     * @param sfRequest $request A request object
//     */
//    public function executeCreateToPlace(sfWebRequest $request)
//    {        // Return nothing to the page 
//        $this->setLayout(sfView::NONE);
//        
//        //Success variable and message
//        $success = 'false';
//        
//        try
//        {
//        
//            // Load the AWS SDK
//            require_once sfConfig::get('app_amazon_sdk_file');
//
//            // Verify the request parameters
//            $userType = $request->getParameter('userType');
//            $originData = $request->getParameter('rides_origin_data');
//            $destinationData = $request->getParameter('rides_destination_data');
//            $routeData = $request->getParameter('rides_route_data');
//            $origin = $request->getParameter('origin');
//            $destination = $request->getParameter('destination');
//            $date = $request->getParameter('date');
//            $time = $request->getParameter('time');
//            $name = $request->getParameter('name');
//            $email = $request->getParameter('email');
//            $phone = $request->getParameter('phone');
//
//            if(CommonHelpers::IsNullOrEmptyString($originData))
//            {
//                throw new Exception('Origin data was not specified. Origin: '.$origin);
//            }
//    }

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
