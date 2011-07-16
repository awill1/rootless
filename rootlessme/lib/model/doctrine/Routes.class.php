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
    public function getOriginLocation()
    {
        $first_leg = $this->getLegs()->getFirst();
        $first_step = $first_leg->getSteps()->getFirst();
        $first_location = $first_step->getLocations()->getFirst();

        return $first_location;
    }

    public function getDestinationLocation()
    {
        $last_leg = $this->getLegs()->getLast();
        $last_step = $last_leg->getSteps()->getLast();
        $last_location = $last_step->getLocations()->getLast();

        return $last_location;
    }

    public function createFromGoogleDirections($googleDirections = null)
    {
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

        // There can be multiple routes, for now just use the first
        $routeNumber = 0;
        $route_data = $jRoute["routes"][$routeNumber];
        $summary = $route_data["summary"];
        $this->setSummary($summary);
        $copyright = $route_data["copyrights"];
        $this->setCopyright($copyright);
        $polyline = $route_data["overview_polyline"]["points"];
        $this->setEncodedPolyline($polyline);

        // Create the legs
        $legsCount = count($jRoute["routes"][$routeNumber]["legs"]);
        for ($currentLeg = 0 ; $currentLeg < $legsCount ; $currentLeg++ )
        {
            $leg_data = $jRoute["routes"][$routeNumber]["legs"][$currentLeg];
            $leg = new Legs();
            $leg->setSequenceOrder($currentLeg);
            $leg->setRoutes($this);
            $leg->save();

            // Create the steps
            $stepsCount = count($leg_data["steps"]);
            for ($currentStep = 0 ; $currentStep < $stepsCount ; $currentStep++ )
            {
                $step_data = $leg_data["steps"][$currentStep];
                $step = new Steps();
                $step->setInstructions($step_data["instructions"]);
                $step->setDistance($step_data["distance"]["value"]);
                $step->setDuration($step_data["duration"]["value"]);
                $step->setEncodedPolyline($step_data["polyline"]["points"]);
                $step->setSequenceOrder($currentStep);
                $step->setLegs($leg);
                $step->save();

                // Create the locations
                $locationsCount = count($step_data["path"]);
                for ($currentLocation = 0 ; $currentLocation < $locationsCount ; $currentLocation++)
                {
                    $location_data = $step_data["path"][$currentLocation];
                    $location = new Locations();
                    // The shortcut accessors for the latitude and longitude
                    // seem to vary with the version of the google map API.
                    // TODO: A permanent soulution needs to be found for the
                    // changing coorinate array keys.
                    $location->setLatitude($location_data['Ja']);
                    $location->setLongitude($location_data['Ka']);
                    $location->setSequenceOrder($currentLocation);
                    $location->setSteps($step);
                    $location->save();
                }
            }
        }

        // Save the route
        $this->save();

        return;
    }
}