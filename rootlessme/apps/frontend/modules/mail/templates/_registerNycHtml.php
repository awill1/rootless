<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      ?><p>Welcome <?php echo $subscriberProfile->getFirstName(); ?>!</p>

<p>And thanks for joining Rootless! We will be connecting you with other people traveling to the same places as matches become available.</p>

<p>Here is what you can look forward to:</p>

<ol>
    <li>We have created a profile for you, which you will use to interact with others.  Please log in at rootless.me with:<br />

    Username:  <?php echo $email; ?><br />
    Password: <?php echo $password; ?><br />
</li>
<li>Please change your password and fill out your profile, so you will be more likely to find great matches. Don't forget a photo!<br /></li>

<li>Check your email! We will send you potential ride matches along your route as they become available.<br /></li>
</ol>


<p>If you have any questions, please email us at contact@rootless.me. Thanks again and welcome!</p>


<p>Enjoy the ride!</p>
<p>The Rootless Team</p>