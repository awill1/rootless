<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
      <title>
            Rootless Me - Error
      </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
    <!-- Google Analytics Javascript -->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-27564018-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
  </head>
  <body>
      <div id="container">

        <!-- Header -->
        <div id="header">
            <a href="/" ><img id="headerLogo" src="/images/Logo.png" alt="RootlessMe" /></a>
            <div id="headerControls">
                <ul id="headerControlsList">
                   
                </ul>
            </div>
        </div>

        <!-- End of header -->

        <div id="content">

            <div id="leftColumn">
               
            </div>

            <!--<div id="rightColumn"><p>This is my rightColumn</p></div> -->

            <div id="middleContent">
             

                <div class="sfTContainer">
                 
                    <div class="sfTMessageWrap">
                      <h1>Oh no! An Error Occurred</h1>
                      <p>The server returned a "<?php echo $code ?> <?php echo $text ?>".</p>
                    </div>
                  </div>

                  <div class="sfTMessageInfo">
                    <h3>Something is broken</h3>
                    <p>Please e-mail us at contact@rootless.me and let us know what you were doing when this error occurred. We will fix it as soon as possible.
                    Sorry for any inconvenience caused.</p>

                    <h3>What's next</h3>
                      <ul class="sfTIconList">
                        <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
                        <li class="sfTLinkMessage"><a href="/dashboard">Go to Dashboard</a></li>
                        <li class="sfTLinkMessage"><a href="/">Go to Homepage</a></li>
                      </ul>
                  </div>
                </div>
                
            </div>
        </div>
        <!-- Footer -->
        <div id="footer">
            <hr class="footerBar" />

            <br />
            <?php 
             $time = time () ; 
             //This line gets the current time off the server

             $year= date("Y",$time); 
             //This line formats it to display just the year

             echo "&copy; 2011-" . $year;
             //this line prints out the copyright date range, you need to edit 2002 to be your opening year
             ?>
             Star Banana, LLC. All rights reserved.
        </div>
        <!-- End of footer -->

    </div>
  </body>
</html>
