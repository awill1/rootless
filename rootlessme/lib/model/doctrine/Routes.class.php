<?php

/**
 * Routes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Routes extends BaseRoutes
{
    /**
     * Gets the origin location of the route
     * @return Locations The origin location
     */
    public function getOriginLocation()
    {
        $first_location = $this->getSortedLocationsQuery('ASC')
                               ->limit(1)
                               ->execute()
                               ->getFirst();

        return $first_location;
    }

    /**
     * Gets the destination location of the route
     * @return Locations The destination location
     */
    public function getDestinationLocation()
    {
        $last_location = $this->getSortedLocationsQuery('DESC')
                              ->limit(1)
                              ->execute()
                              ->getFirst();

        return $last_location;
    }

    /**
     * Creates and saves a route from a Google directions javascript api result 
     * string.
     * @param String $googleDirections The Google directions javascript api 
     * result string with the latitude and longitude keys replaced with "lat" 
     * and "lon".
     * @return void 
     */
    public function createFromGoogleDirections($googleDirections = null)
    {
        // Need to increase the maximum memory limit to allow really long 
        // routes.
        ini_set('memory_limit', '256M');
        
        // Make sure the directions are not null
        if ($googleDirections == null)
        {
            sfContext::getInstance()->getLogger()->err("googleDirections is null.");
            return;
        }

        // The directions should be in JSON format, so decode them
        $jRoute = json_decode($googleDirections, true);
        if (json_last_error() != JSON_ERROR_NONE)
        {
            sfContext::getInstance()->getLogger()->error("JSON last error: ".json_last_error());
            return;
        }
        
        // Do this setting below for BIG-ASS runtime Doctrine systems... FFS!
        Doctrine_Manager::connection()->setAttribute(Doctrine_Core::ATTR_AUTO_FREE_QUERY_OBJECTS, true);

        // There can be multiple routes, for now just use the first
        $routeNumber = 0;
        $route_data = $jRoute["routes"][$routeNumber];
        $summary = $route_data["summary"];
        $this->setSummary($summary);
        $copyright = $route_data["copyrights"];
        $this->setCopyright($copyright);
        $polyline = $route_data["overview_polyline"]["points"];
        $this->setEncodedPolyline($polyline);

        // Increment the sequence order for all detail levels at
        // a route level, instead of nesting. This means the locations
        // can be sorted without joining up to the route level
        $legNumber = 0;
        $stepNumber = 0;
        $locationNumber = 0;

        // Create the legs
        $legsCount = count($jRoute["routes"][$routeNumber]["legs"]);
        for ($currentLeg = 0 ; $currentLeg < $legsCount ; $currentLeg++ )
        {
            $leg_data = $jRoute["routes"][$routeNumber]["legs"][$currentLeg];
            $leg = new Legs();
            $leg->setSequenceOrder($legNumber);
            $leg->setRoutes($this);
            $leg->save();

            // Create the steps
            $stepsCount = count($leg_data["steps"]);
            for ($currentStep = 0 ; $currentStep < $stepsCount ; $currentStep++ )
            {
                // Leave in this debug statement while I am debugging
                // performance issues
                sfContext::getInstance()->getLogger()->debug( 'Saving step '.$currentStep.'of'.$stepsCount );
                  
                  
                $step_data = $leg_data["steps"][$currentStep];
                $step = new Steps();
                $step->setInstructions($step_data["instructions"]);
                $step->setDistance($step_data["distance"]["value"]);
                $step->setDuration($step_data["duration"]["value"]);
                $step->setEncodedPolyline($step_data["polyline"]["points"]);
                $step->setSequenceOrder($stepNumber);
                $step->setLegs($leg);
                $step->save();
                
                // Get the step_id
                $stepId = $step->getStepId();

                $locationsCount = count($step_data["path"]);
                
                // Use a bulk insert class to insert the locations to improve
                // performance. Before bulk insert, only trips of <4 hours 
                // could be saved.
                $bulkInsertQueryGenerator = new LocationsBulkQuery();
                
                // Create the locations
                for ($currentLocation = 0 ; $currentLocation < $locationsCount ; $currentLocation++)
                {
                    $location_data = $step_data["path"][$currentLocation];
                    $location = new Locations();
                    
                    // Use the lat and lon keys that were replaced by the 
                    // javascript                    
                    // Using Arrays instead of the Locations object
                    // for performance reasons
                    $location = Array('latitude' => $location_data['lat'],
                                      'longitude' => $location_data['lon'], 
                                      'sequence_order' => $locationNumber,
                                      'step_id' => $stepId);
                    
                    // Add the location to the bulk query generator
                    $bulkInsertQueryGenerator->Add($location);

                    // Increment the sequence counter
                    $locationNumber++;
                }
                
                // Generate the bulk query and execute it
                $bulkQuery = $bulkInsertQueryGenerator->ToInsertQueryString();
                $q = Doctrine_Manager::getInstance()->getCurrentConnection();
                $result = $q->execute($bulkQuery);
                
                // Free the query resources
                $q->clear();
                unset($bulkQuery);
                unset($bulkInsertQueryGenerator);

                // Increment the sequence counter
                $stepNumber++;
            }
            // Increment the sequence counter
            $legNumber++;
        }

        // Save the route
        $this->save();

        return;
    }

    /**
     * Gets a query that returns all locations associated with the route, in
     * a sorted order.
     * @param string $orderDirection The sort order. 'ASC' and 'DESC' are
     * supported. All others are ignored.
     * @return Doctrine_Query The query that gets the sorted locations
     */
    private function getSortedLocationsQuery($orderDirection)
    {
        // Query should look like
        // select *
        // from locations l
        // inner join steps s
        //   on l.step_id = s.step_id
        // inner join legs le
        //   on s.leg_id = le.leg_id
        // inner join routes r
        //   on le.route_id = r.route_id
        // where r.route_id = 1
        // order by le.sequence_order asc,
        //          s.sequence_order asc,
        //          l.sequence_order asc;
        $q = Doctrine_Query::create()
                ->from('Locations l')
                ->innerJoin('l.Steps s')
                ->innerJoin('s.Legs le')
                ->innerJoin('le.Routes r')
                ->where('r.route_id = ?', $this->getRouteId());

        // Workaround because I cannot figure out how to pass in the order
        // direction from the parameter
        if ($orderDirection == 'ASC')
        {
            $q->orderBy('le.sequence_order ASC, s.sequence_order ASC, l.sequence_order ASC');
        }
        elseif ($orderDirection == 'DESC')
        {
            $q->orderBy('le.sequence_order DESC, s.sequence_order DESC, l.sequence_order DESC');
        }

        return $q;
    }
}