<?php use_stylesheet(sfConfig::get('app_css_special')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Patriots'))
?>
<script type="text/javascript">
    $(document).ready(function()
    {
    $("#backgroundImage").attr("src", "/images/patFansBackground.jpg" );
    });
    
</script>
<div id="socialLinks">
        <a href="http://www.twitter.com/rootlessme"><img src="/images/twitter.png" /></a>
        <a href="http://www.facebook.com/rootlessme"><img src="/images/facebook.png" /></a>
    </div>
<div id="main">
    
    <div id="headline">
        Ride with other Patriots fans to the next game. 
    </div>
    <div id="formBox">
        <form action="html_form_action.asp" method="post">
            <div id="formButtons">
                I want to <input type="radio" name="userType" value="drive" />Drive or <input type="radio" name="userType" value="ride" />Ride
            </div>
            <div id="formFields">
                <input type="text" name="name" placeholder="Name"/>
                <input type="text" name="email" placeholder="Email"/>
                
                <select name="game">
                    <option value="game1">game1</option>
                    <option value="game2">game2</option>
                    <option value="game3">game3</option>
                    <option value="game4">game4</option>
                </select>
                <br />
                <input type="text" name="location" placeholder="Address, City, State"/>
                <input type="submit" value="Submit" />
            </div>
        </form>    
        <div id="formConfirmations">
            <div class="boxCopy">
                Thanks for ridesharing with Rootless! Your potential ride matches will be emailed to you as they become available. 
                <br /><br />
                Share this with your friends!
            </div>
        </div>
        
        <div class="boxCopy">
            
        </div>
    </div>
</div>