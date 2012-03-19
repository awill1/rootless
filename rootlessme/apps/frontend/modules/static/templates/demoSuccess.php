<?php slot(
  'title',
  sprintf('Rootless Me - Demo'))
?>

<div>
    <h1>Demo Site</h1>
    <p>
        Our site isn't ready yet, but we are getting close. To help you see
        what we are working on we have created this demo site. We want your 
        input to help make rootless.me the best ridesharing community in the 
        world. Send your feedback 
        <a href="mailto:contact@rootless.me">contact@rootless.me</a>. 
    </p>
    <p>    
        Please understand this is just a demo website. Anything your create 
        on the site can be deleted without notice. Please do not 
        negotiate real rides with people. You will have to wait for the beta 
        release. We are working on fixing bugs and some small features
        features for our launch. We have a two different demo options for you.
    </p>
    <h2>Scripted Demo</h2>
    <p>
        To see the best of what we have been working on, (and avoiding some 
        of the in progress areas) check out this basic script.
        <ol>
            <li>Register for an account on our 
                <a href="<?php echo url_for('home');?>">home page</a>. It's 
                quick, we promise.
            </li>
            <li>Pretend you are a student at the University of Toledo and you 
                need to get to a job interview in the Willis Tower in Chicago
                on June 7, 2012. To see if there are any rides in rootless.me 
                that will help you get to your destination click 
                <strong>rides</strong>. Search for a ride 
                from your dorm <strong>2855 South Glass Bowl Dr., Toledo, OH</strong> 
                to the Willis Tower  
                <strong>233 South Wacker Drive, Chicago, IL</strong> on <strong>06/07/2012</strong>.</li>
            <li>Compare the rides to find a best match. Notice how rootless.me
                searches along the route to find a match. Passengers whose 
                origin and destination are convenient enough to a drivers 
                route are found. Our competition requires the driver and passenger
                to have origins and destinations close to each other to make a
                match. 
            </li>
            <li>Ask for a seat with the best ride match. Make sure to enter the
                exact addresses you want to be picked up 
                (<strong>2855 South Glass Bowl Dr., Toledo, OH</strong>) and dropped off 
                (<strong>233 South Wacker Drive, Chicago, IL</strong>). Feel free to choose
                a price that you think is fair. The driver in the car can
                negotiate with the passenger on the price, date, time, location, 
                and number of seats until they come to a consensus. Eventually, 
                the negotiations will be accepted or declined.                
            </li>
            <li>
                Now imagine after your interview you want to meet your friends
                at the house boat they have rented on Lake Cumberland in 
                Kentucky. No public transportation serves this area. Search for
                a ride from your Chicago hotel <strong>172 West Adams Street, 
                Chicago, IL</strong>to the dock where you are going to meet your 
                friends <strong>3677 Kentucky 92, Jamestown, KY</strong>.
            </li>
            <li>Unfortunately, there are no rides that match your needs. 
                Create a ride request post by clicking <strong>+ Request a 
                ride</strong>. Create our ride using <strong>172 West Adams Street, 
                Chicago, IL</strong> as the origin and <strong>3677 Kentucky 92,
                Jamestown, KY</strong> as the destination. Hopefully a compatible
                driver will find your ride request post and will help you get to the
                boat house.
            </li>
            <li>
                Imaging your ride to Chigago went very well. The driver was nice,
                on time, and it was overall a really positive experience. You 
                should review the driver so their reputation in the rootless 
                community will grow. Use the <strong>travelers</strong> page to
                find the driver who you rode with. On their profile page, leave
                a review and give them the praise they deserve.
            </li>
            <li>
                One more thing to notice, our site works internationally. Search
                for a ride from Munich, Germany to Paris, France. We do not have
                any international rides in our demo database, but it is pretty
                cool to know we can support ride sharing in other countries.
            </li>
        </ol>
    </p>
    <h2>Free form demo</h2>
    <p>
        To just play around on our site, register on our
        <a href="<?php echo url_for('home');?>">home page</a>. Or, browse around
        the <a href="<?php echo url_for('ride');?>">rides</a> and 
        <a href="<?php echo url_for('profile');?>">travelers</a> pages.
    </p>
</div>