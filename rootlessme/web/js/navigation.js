/*
 * This file contains the javascript required for navigation
 *
 * Written by awilliams
 * 05/23/2011
 */

$(document).ready(function()
{
    /* hacky nav highlighting */
    var loc = window.location.href;

    // Add the navigation item class to all navigation items
    $('#navigation li').removeClass();
    $('#navigation li').addClass('navigationItem');

    // Add class to current section...
    // Dashboard
    if(loc.indexOf('/dashboard') > -1){
           $('#navigationDashboard').removeClass('navigationItem');
           $('#navigationDashboard').addClass('navigationItemSelected');
    }
    // Rides
    else if(loc.indexOf('/rides') > -1){
           $('#navigationRides').removeClass('navigationItem');
           $('#navigationRides').addClass('navigationItemSelected');
    }
    // Travelers
    else if(loc.indexOf('/profiles') > -1){
           $('#navigationTravelers').removeClass('navigationItem');
           $('#navigationTravelers').addClass('navigationItemSelected');
    }
    // Messages
    else if(loc.indexOf('/messages') > -1){
           $('#navigationMessages').removeClass('navigationItem');
           $('#navigationMessages').addClass('navigationItemSelected');
    }


});
