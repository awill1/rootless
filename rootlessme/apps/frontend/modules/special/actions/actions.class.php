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
        $this->destination = '411 Woody Hayes Drive, Columbus, OH';
        
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
        $this->destination = 'One Patriot Place Foxborough, MA';
        
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
     * Executes werkout action
     *
     * @param sfRequest $request A request object
     */
    public function executeWerkout(sfWebRequest $request)
    {
        $this->festivalName = 'The Werk Out';
        
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to The Werk Out Music & Arts Festival 2012';
        $this->destination = '7400 Kindle Rd., Thornville, OH';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'preseason1' => array(
                'date' => '2012-12-23 23:00:00.0',
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
     * Executes Voodoo action
     *
     * @param sfRequest $request A request object
     */
    public function executeVoodoo(sfWebRequest $request)
    {
        $this->festivalName = 'Voodoo';
        
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to Voodoo 2012';
        $this->destination = 'City Park, New Orleans, LA';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-10-26 23:00:00.0',
                'id' => 'Voodoo_10/26/2012_CityParkNewOrleansLA',
                'displayName' => 'Voodoo 10/26'),
            'day2' => array(
                'date' => '2012-10-27 23:00:00.0',
                'id' => 'Voodoo_10/27/2012_CityParkNewOrleansLA',
                'displayName' => 'Voodoo 10/27'),
            'day3' => array(
                'date' => '2012-10-28 23:00:00.0',
                'id' => 'Voodoo_10/28/2012_CityParkNewOrleansLA',
                'displayName' => 'Voodoo 10/28'),
            'anyDay' => array(
                'date' => '2012-10-28 23:00:00.0',
                'id' => 'Voodoo_10/26-28/2012_Any_CityParkNewOrleansLA',
                'displayName' => 'Voodoo any day.'),
            'allDays' => array(
                'date' => '2012-10-28 23:00:00.0',
                'id' => 'Voodoo_10/26-28/2012_Every_CityParkNewOrleansLA',
                'displayName' => 'Voodoo every day.'));
            
            

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "voodooBackground2.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    /**
     * Executes Halifax Pop action
     *
     * @param sfRequest $request A request object
     */
    public function executeHalifaxPop(sfWebRequest $request)
    {
        $this->festivalName = 'Halifax Pop Explosion';
        
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to Halifax Pop Explosion Festival & Conference 2012';
        $this->destination = '1980 Robie Street, Halifax, Nova Scotia, Canada';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '352%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-10-16 23:00:00.0',
                'id' => 'HPX_10/16/2012_HalifaxNSCA',
                'displayName' => 'HPX 10/16'),
            'day2' => array(
                'date' => '2012-10-17 23:00:00.0',
                'id' => 'HPX_10/17/2012_HalifaxNSCA',
                'displayName' => 'HPX 10/17'),
            'day3' => array(
                'date' => '2012-10-18 23:00:00.0',
                'id' => 'HPX_10/18/2012_HalifaxNSCA',
                'displayName' => 'HPX 10/18'),
            'day4' => array(
                'date' => '2012-10-19 23:00:00.0',
                'id' => 'HPX_10/19/2012_HalifaxNSCA',
                'displayName' => 'HPX 10/19'),
            'day5' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'HPX_10/20/2012_HalifaxNSCA',
                'displayName' => 'HPX 10/20'),
            'anyDay' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'HPX_10/16-20/2012_Any_HalifaxNSCA',
                'displayName' => 'HPX any day.'),
            'allDays' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'HPX_10/16-20/2012_Every_HalifaxNSCA',
                'displayName' => 'HPX every day.'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "hpxBackground2.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    
    /**
     * Executes Harvest Music Festival action
     *
     * @param sfRequest $request A request object
     */
    public function executeHarvestMusicFestival(sfWebRequest $request)
    {
        $this->festivalName = 'Harvest Music Festival';
        
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to Yonder Mountain String Band\'s Harvest Music Festival 2012';
        $this->destination = '23978 Arkansas 23 Ozark National Forest, Ozark, AR 72949';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '352%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-10-11 23:00:00.0',
                'id' => 'Harvest_10/11/2012_MulberryMountainAR',
                'displayName' => 'Harvest 10/11'),
            'day2' => array(
                'date' => '2012-10-12 23:00:00.0',
                'id' => 'Harvest_10/12/2012_MulberryMountainAR',
                'displayName' => 'Harvest 10/12'),
            'day3' => array(
                'date' => '2012-10-13 23:00:00.0',
                'id' => 'Harvest_10/13/2012_MulberryMountainAR',
                'displayName' => 'Harvest 10/13'),
            'anyDay' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'Harvest_10/11-13/2012_Any_MulberryMountainAR',
                'displayName' => 'Harvest any day.'),
            'allDays' => array(
                'date' => '2012-10-20 23:00:00.0',
                'id' => 'Harvest_10/11-13/2012_Every_MulberryMountainAR',
                'displayName' => 'Harvest every day.'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "harvestBackground.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    
/**
     * Executes Shark Tank action
     *
     * @param sfRequest $request A request object
     */
    public function executeSharkTank(sfWebRequest $request)
    {
        $this->festivalName = 'The FutureM Shark Tank';
        $this->peopleName = 'chum';
        $this->title = 'Rootless - Ride with other chum to The FutureM Shark Tank 2012';
        $this->destination = '1 Memorial Drive, Cambridge MA';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '352%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-10-25 23:00:00.0',
                'id' => 'SharkTank_10/25/2012_CambridgeMA',
                'displayName' => 'The FutureM Shark Tank 10/25'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "sharkTankBackground.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    /**
     * Executes Nova Scotia Music Week action
     *
     * @param sfRequest $request A request object
     */
    public function executeNovaScotiaMusicWeek(sfWebRequest $request)
    {
        $this->festivalName = 'Nova Scotia Music Week';
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to Nova Scotia Music Week 2012';
        $this->destination = 'Liverpool, Nova Scotia';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '352%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-11-08 23:00:00.0',
                'id' => 'NSMW_11/08/2012_LiverpoolNS',
                'displayName' => 'Music Week 11/08'),
            'day2' => array(
                'date' => '2012-11-09 23:00:00.0',
                'id' => 'NSMW_11/09/2012_LiverpoolNS',
                'displayName' => 'Music Week 11/09'),
            'day3' => array(
                'date' => '2012-11-10 23:00:00.0',
                'id' => 'NSMW_11/10/2012_LiverpoolNS',
                'displayName' => 'Music Week 11/10'),
            'day4' => array(
                'date' => '2012-11-11 23:00:00.0',
                'id' => 'NSMW_11/11/2012_LiverpoolNS',
                'displayName' => 'Music Week 11/11'),
            'anyDay' => array(
                'date' => '2012-11-11 23:00:00.0',
                'id' => 'NSMW_11/08-11/2012_Any_LiverpoolNS',
                'displayName' => 'Music Week any day.'),
            'allDays' => array(
                'date' => '2012-11-11 23:00:00.0',
                'id' => 'NSMW_10/08-11/2012_Every_LiverpoolNS',
                'displayName' => 'Music Week every day.'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "nsmwBackground.jpg";
        
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
        $this->destination = '1345 Main St, Cincinnati, OH';
        
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
     * Executes Hangtown Halloween Ball action
     *
     * @param sfRequest $request A request object
     */
    public function executeHangtownHalloweenBall(sfWebRequest $request)
    {
        $this->festivalName = 'Hangtown Halloween Ball';
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to the Hangtown Halloween Ball 2012 in Placerville, California';
        $this->destination = 'Armory Road, Placerville, CA';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '352%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-10-25 23:00:00.0',
                'id' => 'HangtownHalloweenBall_10/25/2012_PlacervilleCA',
                'displayName' => 'Thursday, October 25th'),
            'day2' => array(
                'date' => '2012-10-26 23:00:00.0',
                'id' => 'HangtownHalloweenBall_10/26/2012_PlacervilleCA',
                'displayName' => 'Friday, October 26th'),
            'day3' => array(
                'date' => '2012-10-27 23:00:00.0',
                'id' => 'HangtownHalloweenBall_10/27/2012_PlacervilleCA',
                'displayName' => 'Saturday, October 27th'),
            'day4' => array(
                'date' => '2012-10-28 23:00:00.0',
                'id' => 'HangtownHalloweenBall_10/28/2012_PlacervilleCA',
                'displayName' => 'Sunday, October 28th'),
            'day5' => array(
                'date' => '2012-10-29 23:00:00.0',
                'id' => 'HangtownHalloweenBall_10/29/2012_PlacervilleCA',
                'displayName' => 'Monday, October 29th'),
            'anyDay' => array(
                'date' => '2012-10-29 23:00:00.0',
                'id' => 'HangtownHalloweenBall_Any_PlacervilleCA',
                'displayName' => 'Halloween Ball any day.'),
            'allDays' => array(
                'date' => '2012-10-29 23:00:00.0',
                'id' => 'HangtownHalloweenBall_Every_PlacervilleCA',
                'displayName' => 'Halloween Ball every day.'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "hangtownBackground.jpg";
        
        // Use the festival template
        $this->setTemplate('festival');
    }
    
    
    /**
     * Executes Mullum Music Festival action
     *
     * @param sfRequest $request A request object
     */
    public function executeMullum(sfWebRequest $request)
    {
        $this->festivalName = 'The Mullum Music Festival';
        $this->peopleName = 'festival goers';
        $this->title = 'Rootless - Ride with other festival goers to the Mullum Music Festival 2012 in Mullumbimby, NSW';
        $this->destination = 'Mullumbimby NSW , Australia';
        $this->headlineColor = '#ffffff';
        $this->fontSize = '335%';
        $this->textShadow = '0 0 15px rgba(0, 0, 0, 0.8), 0 -1px 1px rgba(0, 0, 0, 0.6)';
        
        // Build a dynamic schedule. Eventually this will go into a separate file.
        $fullSchedule = array(
            'day1' => array(
                'date' => '2012-11-22 23:00:00.0',
                'id' => 'MullumMusicFestival_11/22/2012_MullumbimbyNSW',
                'displayName' => 'Thursday, 22 November'),
            'day2' => array(
                'date' => '2012-11-23 23:00:00.0',
                'id' => 'MullumMusicFestival_11/23/2012_MullumbimbyNSW',
                'displayName' => 'Friday, 23 November'),
            'day3' => array(
                'date' => '2012-11-24 23:00:00.0',
                'id' => 'MullumMusicFestival_11/24/2012_MullumbimbyNSW',
                'displayName' => 'Saturday, 24 November'),
            'day4' => array(
                'date' => '2012-11-25 23:00:00.0',
                'id' => 'MullumMusicFestival_11/25/2012_MullumbimbyNSW',
                'displayName' => 'Sunday, 25 November'),
            'anyDay' => array(
                'date' => '2012-11-25 23:00:00.0',
                'id' => 'MullumMusicFestival_Any_MullumbimbyNSW',
                'displayName' => 'Mullum Music Festival any day'),
            'allDays' => array(
                'date' => '2012-11-25 23:00:00.0',
                'id' => 'MullumMusicFestival_Every_MullumbimbyNSW',
                'displayName' => 'Mullum Music Festival every day.'));

        // Only include the games that are in the future
        $this->games = $this->getFutureGames($fullSchedule);
        
        //Set background image
        $this->backgroundImage = "mullumBackground.jpg";
        
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
        $this->destination = '69 Waterman St, Providence, RI';
        
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
     * Executes NYC action
     *
     * @param sfRequest $request A request object
     */
    public function executeNyc(sfWebRequest $request)
    {
//        $this->festivalName = 'the BWxD Conference';
//        
//        $this->peopleName = 'attendees';
        $this->title = 'Rootless - Carpool into New York City';
//        $this->destination = '69 Waterman St, Providence, RI';
//        
//        // Build a dynamic schedule. Eventually this will go into a separate file.
//        $fullSchedule = array(
//            'day1' => array(
//                'date' => '2012-09-28 23:00:00.0',
//                'id' => 'ABetterWorld_9/28/2012_CincinnatiOH',
//                'displayName' => 'A Better World By Design 9/28'),
//            'day2' => array(
//                'date' => '2012-09-29 23:00:00.0',
//                'id' => 'ABetterWorld_9/29/2012_CincinnatiOH',
//                'displayName' => 'A Better World By Design 9/29'),
//            'day3' => array(
//                'date' => '2012-09-30 23:00:00.0',
//                'id' => 'ABetterWorld_9/30/2012_CincinnatiOH',
//                'displayName' => 'A Better World By Design 9/30'),
//            'allDays' => array(
//                'date' => '2012-09-30 23:00:00.0',
//                'id' => 'ABetterWorld_9/28-30/2012_ProvidenceRI',
//                'displayName' => 'A Better World By Design All Days'));
//
//        // Only include the games that are in the future
//        $this->games = $this->getFutureGames($fullSchedule);
//        
//        //Set background image
//        $this->backgroundImage = "abetterworld_background.jpg";
        
        // Use the festival template
        $this->setTemplate('nyc');
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
        $destination = $request->getParameter('destination');
        $name = $request->getParameter('name');
        $seats = $request->getParameter('seats');
        $userType = $request->getParameter('userType');
        
        // Create the user if necessary
        $isExistingUser = FALSE;
        $password = NULL;
        $wasUserCreated = FALSE;
        // Make sure the email was passed in. Prevent null and empty ones.
        if(!CommonHelpers::IsNullOrEmptyString($email))
        {
            // Check to see if user is already in our database
            $user = Doctrine::getTable('sfGuardUser')->getUserByEmail($email);

            // If no, create a new user instance and populate with the minumum data
            if(!$user)
            {
                $password = CommonHelpers::CreateTemporaryPassword();
                $firstName = CommonHelpers::getFirstName($name);
                $lastName = CommonHelpers::getLastName($name);
                $user = sfGuardUser::createMinimumUser($email, $password, $firstName, $lastName);
                if (user)
                {
                    $wasUserCreated = TRUE;
                }
            }
            else
            {
                // The user already exists
                $isExistingUser = TRUE;
            }
        }
        
        //check to see if administration notifications are desried
        if (sfConfig::get('app_send_administration_notifications'))
        {
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
                Destination: %destination%
                Seats: %seats%
                
                User account:";
            if ($isExistingUser)
            {
                $messageTemplate = $messageTemplate."
                    The user already exists.
                    Email: %email%
                    Password: Exists
                    ";
            }
            else
            {
                if ($wasUserCreated)
                {
                    // A new user was created
                    $messageTemplate = $messageTemplate."
                    The user was created.
                    Email: %email%
                    Password: %password%
                    ";
                }
                else
                {
                    // A user was not creted for some reason
                    $messageTemplate = $messageTemplate."
                    The user was NOT created.
                    Email: %email%
                    Password: 
                    ";
                }
            }
            
            // Add in the email message
            $messageTemplate = $messageTemplate."
                Welcome subject:
Welcome to Rootless! Your ride has been posted.

                Welcome email:
Welcome %name%!

And thanks for joining Rootless! We will be connecting you with other people traveling to the same event as matches become available.

Here is what you can look forward to:


1. We have created a profile for you, which you will use to interact with others.  Please log in at rootless.me with:

    Username: %email%
    Password: %password%

2. Please change your password and fill out your profile, so you will be more likely to find great matches. Don't forget a photo!

3. Your ride has been posted %RIDE_LINK%. Feel free to share the link with your other social networks! 

4. Check your email! We will send you potential ride matches along your route as they become available.


If you have any questions, please email us at contact@rootless.me. Thanks again and welcome!


Enjoy the ride!
The Rootless Team
                ";
            
            $formattedMessage = strtr($messageTemplate, array(
                '%userType%'    => $userType,
                '%name%'        => $name,
                '%email%'       => $email,
                '%game%'        => $game,
                '%location%'    => $location,
                '%destination%' => $destination,
                '%password%'    => $password,
                '%seats%'       => $seats
            ));
            $subjectTemplate = "%email% has registered for %game%";
            $formattedSubject = strtr($subjectTemplate, array(
                '%email%'     => $email,
                '%game%'      => $game
            ));
            $snsService->publish(sfConfig::get('app_amazon_sns_site_activity_arn'), 
                    $formattedMessage, 
                    array('Subject' => $formattedSubject));

            
        }
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
