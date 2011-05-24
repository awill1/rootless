/*
 * This file contains the javascript required for the menu in the header
 *
 * Written by awilliams
 * 05/23/2011
 */


        var timeout    = 500;
        var closetimer = 0;
        var ddmenuitem = 0;

        function jsddm_open()
        {  jsddm_canceltimer();
           jsddm_close();
           ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

        function jsddm_close()
        {  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

        function jsddm_timer()
        {  closetimer = window.setTimeout(jsddm_close, timeout);}

        function jsddm_canceltimer()
        {  if(closetimer)
           {  window.clearTimeout(closetimer);
              closetimer = null;}}

        $(document).ready(function()
        {  $('.headerControlsListItem').bind('mouseover', jsddm_open)
           $('.headerControlsListItem').bind('mouseout',  jsddm_timer)});

        document.onclick = jsddm_close;