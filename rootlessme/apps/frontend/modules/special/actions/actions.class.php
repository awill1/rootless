<?php

/**
 * special actions.
 *
 * @package    RootlessMe
 * @subpackage special
 * @author     rwells
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class specialActions extends sfActions
{
    /**
     * Executes buckeyes action
     *
     * @param sfRequest $request A request object
     */
    public function executeBuckeyes(sfWebRequest $request)
    {
        $this->teamNameSingular = 'Buckeye';
        $this->teamNamePlural = 'Buckeyes';
        $this->fansName = 'Buckeye fans';
        $this->title = 'Rootless - Ride with other Ohio State Buckeye fans to the game. The most fun gameday carpool.';
        
        // Build a dynamic schedule. Eventually this will go into a separate file

        $fullSchedule = array(
            'regularSeason1' => array(
                'date' => '2012-09-01 23:00:00.0',
                'id' => 'OSU_2012-09-01_vs._Miami_OH',
                'displayName' => '9/01 vs. Miami (OH)'),
            'regularSeason2' => array(
                'date' => '2012-09-08 23:00:00.0',
                'id' => 'OSU_2012-09-08_vs._UCF',
                'displayName' => '9/08 vs. UCF' ),
            'regularSeason3' => array(
                'date' => '2012-09-15 23:00:00.0',
                'id' => 'OSU_2012-09-15_vs._California',
                'displayName' => '9/15 vs. California' ),
            'regularSeason4' => array(
                'date' => '2012-09-22 23:00:00.0',
                'id' => 'OSU_2012-09-22_vs._UAB',
                'displayName' => '9/22 vs. UAB' ),
            'regularSeason5' => array(
                'date' => '2012-09-29 23:00:00.0',
                'id' => 'OSU_2012-09-29_at_Michigan_State',
                'displayName' => '9/29 @ Michigan State' ),
            'regularSeason6' => array(
                'date' => '2012-10-06 23:00:00.0',
                'id' => 'OSU_2012-10-06_vs.Nebraska',
                'displayName' => '10/06 vs. Nebraska' ),
            'regularSeason7' => array(
                'date' => '2012-10-13 23:00:00.0',
                'id' => 'OSU_2012-10-13_at_Indiana',
                'displayName' => '10/13 @ Indiana' ),
            'regularSeason8' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'OSU_2012-10-20_vs._Purdue',
                'displayName' => '10/20 vs. Purdue' ),
            'regularSeason9' => array(
                'date' => '2012-10-27 23:00:00.0',
                'id' => 'OSU_2012-10-27_at_Penn_State',
                'displayName' => '10/27 @ Penn State' ),
            'regularSeason10' => array(
                'date' => '2012-11-03 23:00:00.0',
                'id' => 'OSU_2012-11-03_vs._Illinois',
                'displayName' => '11/03 vs. Illinois' ),
            'regularSeason11' => array(
                'date' => '2012-11-17 23:00:00.0',
                'id' => 'OSU_2012-11-17_at_Wisconsin',
                'displayName' => '11/17 @ Wisconsin' ),
            'regularSeason12' => array(
                'date' => '2012-11-24 23:00:00.0',
                'id' => 'OSU_2012-11-24_vs._Michigan',
                'displayName' => '11/24 vs. Michigan' ),
            'allHome' => array(
                'date' => '2012-11-24 23:00:00.0',
                'id' => 'OSU_2012_all_home',
                'displayName' => 'All home games' ),
            'allAway' => array(
                'date' => '2012-11-24 23:00:00.0',
                'id' => 'OSU_2012_all_away',
                'displayName' => 'All away games' ),
            'allHomeAndAway' => array(
                'date' => '2012-11-24 23:00:00.0',
                'id' => 'OSU_2012_all_home_and_away',
                'displayName' => 'All home and away games' ));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "buckeyesBG.jpg";
        
        // Use the Patriots template
        $this->setTemplate('patriots');
       
    }
    
    /**
     * Executes patriots action
     *
     * @param sfRequest $request A request object
     */
    public function executePatriots(sfWebRequest $request)
    {
        $this->teamNameSingular = 'Patriot';
        $this->teamNamePlural = 'Patriots';
        $this->fansName = 'Patriots fans';
        $this->title = 'Rootless - Ride with other New England Patriots fans to Gillette Stadium in Foxborough. The most fun gameday carpool.';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'preseason1' => array(
                'date' => '2012-08-09 23:00:00.0',
                'id' => 'Patriots_2012-08-09_vs._Saints',
                'displayName' => '8/9 vs. Saints'),
            'preseason2' => array(
                'date' => '2012-08-20 23:00:00.0',
                'id' => 'Patriots_2012-08-20_vs._Eagles',
                'displayName' => '8/20 vs. Eagles'),
            'regularSeason01' => array(
                'date' => '2012-09-09 23:00:00.0',
                'id' => 'Patriots_2012-09-09_at_Titans',
                'displayName' => '9/9 @ Titans'),
            'regularSeason02' => array(
                'date' => '2012-09-16 23:00:00.0',
                'id' => 'Patriots_2012-09-16_vs._Cardinals',
                'displayName' => '9/16 vs. Cardinals'),
            'regularSeason03' => array(
                'date' => '2012-09-23 23:00:00.0',
                'id' => 'Patriots_2012-09-23_at_Ravens',
                'displayName' => '9/23 @ Ravens'),
            'regularSeason04' => array(
                'date' => '2012-09-30 23:00:00.0',
                'id' => 'Patriots_2012-09-30_at_Bills',
                'displayName' => '9/30 @ Bills'),
            'regularSeason05' => array(
                'date' => '2012-10-07 23:00:00.0',
                'id' => 'Patriots_2012-10-07_vs._Broncos',
                'displayName' => '10/7 vs. Broncos' ),
            'regularSeason06' => array(
                'date' => '2012-10-14 23:00:00.0',
                'id' => 'Patriots_2012-10-14_at_Seahawks',
                'displayName' => '10/14 @ Seahawks'),
            'regularSeason07' => array(
                'date' => '2012-10-21 23:00:00.0',
                'id' => 'Patriots_2012-10-21_vs._Jets',
                'displayName' => '10/21 vs. Jets' ),
            'regularSeason08' => array(
                'date' => '2012-10-28 23:00:00.0',
                'id' => 'Patriots_2012-10-28_at_Rams',
                'displayName' => '10/28 @ Rams'),
            'regularSeason09' => array(
                'date' => '2012-11-11 23:00:00.0',
                'id' => 'Patriots_2012-11-11_vs._Bills',
                'displayName' => '11/11 vs. Bills' ),
            'regularSeason10' => array(
                'date' => '2012-11-18 23:00:00.0',
                'id' => 'Patriots_2012-11-18_vs._Colts',
                'displayName' => '11/18 vs. Colts' ),
            'regularSeason11' => array(
                'date' => '2012-11-22 23:00:00.0',
                'id' => 'Patriots_2012-11-22_at_Jets',
                'displayName' => '11/22 @ Jets'),
            'regularSeason12' => array(
                'date' => '2012-12-02 23:00:00.0',
                'id' => 'Patriots_2012-12-02_at_Dolphins',
                'displayName' => '12/02 @ Dolphins'),
            'regularSeason13' => array(
                'date' => '2012-12-10 23:00:00.0',
                'id' => 'Patriots_2012-12-10_vs._Texans',
                'displayName' => '12/10 vs. Texans' ),
            'regularSeason14' => array(
                'date' => '2012-12-16 23:00:00.0',
                'id' => 'Patriots_2012-12-16_vs._49ers',
                'displayName' => '12/16 vs. 49ers' ),
            'regularSeason15' => array(
                'date' => '2012-12-23 23:00:00.0',
                'id' => 'Patriots_2012-12-23_at_Jaguars',
                'displayName' => '12/23 @ Jaguars'),
            'regularSeason16' => array(
                'date' => '2012-12-30 23:00:00.0',
                'id' => 'Patriots_2012-12-30_vs._Dolphins',
                'displayName' => '12/30 vs. Dolphins' ),
            'allHome' => array(
                'date' => '2012-12-30 23:00:00.0',
                'id' => 'Patriots_2012_all_home',
                'displayName' => 'All home games' ),
            'allAway' => array(
                'date' => '2012-12-30 23:00:00.0',
                'id' => 'Patriots_2012_all_away',
                'displayName' => 'All away games' ),
            'allHomeAndAway' => array(
                'date' => '2012-12-30 23:00:00.0',
                'id' => 'Patriots_2012_all_home_and_away',
                'displayName' => 'All home and away games' ));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "patFansNew.jpg";
    }
    
    /**
     * Executes patriots 2 action
     *
     * @param sfRequest $request A request object
     */
    public function executePatriots2(sfWebRequest $request)
    {
        $this->executePatriots($request);
    }
    
    /**
     * Executes werkout action
     *
     * @param sfRequest $request A request object
     */
    public function executeWerkout(sfWebRequest $request)
    {
        $this->festivalName = 'The Werk Out';
        
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to The Werk Out Music & Arts Festival 2012';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'preseason1' => array(
                'date' => '2012-09-23 23:00:00.0',
                'id' => 'WerkOut_9/20-23/2012_LegendValleyThornvilleOH',
                'displayName' => 'The Werk Out 9/20-23/2012'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "werkoutBackground.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    /**
     * Executes Midpoint Music Festival 2012 action
     *
     * @param sfRequest $request A request object
     */
    public function executeMpmf12(sfWebRequest $request)
    {
        $this->festivalName = 'MPMF 2012';
        
        $this->peopleName = 'music fans';
        $this->title = 'Rootless - Ride with other '.$this->peopleName.' to MidPoint Music Festival 2012';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-09-27 23:00:00.0',
                'id' => 'MPMF.12_9/27/2012_CincinnatiOH',
                'displayName' => 'MPMF.12 9/27'),
            'day2' => array(
                'date' => '2012-09-28 23:00:00.0',
                'id' => 'MPMF.12_9/28/2012_CincinnatiOH',
                'displayName' => 'MPMF.12 9/28'),
            'day3' => array(
                'date' => '2012-09-29 23:00:00.0',
                'id' => 'MPMF.12_9/29/2012_CincinnatiOH',
                'displayName' => 'MPMF.12 9/29'),
            'allDays' => array(
                'date' => '2012-09-29 23:00:00.0',
                'id' => 'MPMF.12_9/27-29/2012_CincinnatiOH',
                'displayName' => 'MPMF.12 All Days'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "mpmf12_webbackground_yellow_1280x800.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    /**
     * Executes Better World By Design action
     *
     * @param sfRequest $request A request object
     */
    public function executeABetterWorldByDesign(sfWebRequest $request)
    {
        $this->festivalName = 'the BWxD Conference';
        
        $this->peopleName = 'attendees';
        $this->title = 'Rootless - Ride with others to the A Better World By Design Conference';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-09-28 23:00:00.0',
                'id' => 'ABetterWorld_9/28/2012_CincinnatiOH',
                'displayName' => 'A Better World By Design 9/28'),
            'day2' => array(
                'date' => '2012-09-29 23:00:00.0',
                'id' => 'ABetterWorld_9/29/2012_CincinnatiOH',
                'displayName' => 'A Better World By Design 9/29'),
            'day3' => array(
                'date' => '2012-09-30 23:00:00.0',
                'id' => 'ABetterWorld_9/30/2012_CincinnatiOH',
                'displayName' => 'A Better World By Design 9/30'),
            'allDays' => array(
                'date' => '2012-09-30 23:00:00.0',
                'id' => 'ABetterWorld_9/28-30/2012_ProvidenceRI',
                'displayName' => 'A Better World By Design All Days'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "abetterworld_background.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }

    /**
     * Executes special events register action
     *
     * @param sfRequest $request A request object
     */
    public function executeRegister(sfWebRequest $request)
    {
        // Load the AWS SDK
        require_once sfConfig::get('app_amazon_sdk_file');
        
        // Verify the request parameters
        $email = $request->getParameter('email');
        $game = $request->getParameter('game');
        $location = $request->getParameter('location');
        $name = $request->getParameter('name');
        $seats = $request->getParameter('seats');
        $userType = $request->getParameter('userType');
        
        // Send the notification using Amazon SNS  
        $snsService = new AmazonSNS(array('key' => sfConfig::get('app_amazon_sns_access_key'), 
                                          'secret' => sfConfig::get('app_amazon_sns_secret_key')));
        $messageTemplate = 
            "New Special event request.
            UserType: %userType%
            Name: %name%
            Email: %email%
            Game: %game%
            Location: %location%
            Seats: %seats%";
        $formattedMessage = strtr($messageTemplate, array(
            '%userType%'  => $userType,
            '%name%'      => $name,
            '%email%'     => $email,
            '%game%'      => $game,
            '%location%'  => $location,
            '%seats%'     => $seats
        ));
        $subjectTemplate = "%email% has registered for %game%";
        $formattedSubject = strtr($subjectTemplate, array(
            '%email%'     => $email,
            '%game%'      => $game
        ));
        $snsService->publish(sfConfig::get('app_amazon_sns_site_activity_arn'), 
                $formattedMessage, 
                array('Subject' => $formattedSubject));
        
        // Return nothing to the page 
        $this->setLayout(sfView::NONE);
        return $this->renderText("{ success: true }");
    }
    
    /**
     * Gets the list of future games in the schedule
     * @param Array $fullSchedule The full schedule for the season including past games
     * @return Array The games that will still happen in the future 
     */
    private function getFutureGames($fullSchedule)
    {
        $futureGames = array();
        foreach ($fullSchedule as $game) {
            if ($this->isFuture($game['date']))
            {
                $futureGames[] = $game;
            }
        }
        
        return $futureGames;
    }
    
    /**
     * Checks to see if the time is in the future
     * @param String $time The time string to compare
     * @return Boolean True, if the time is in the future. False, otherwise. 
     */
    private function isFuture($time)
    {
        return (strtotime($time) > time());
    }
}
