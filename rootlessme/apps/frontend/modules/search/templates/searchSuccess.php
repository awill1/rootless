<h1>Search Results</h1>

<h2>Travelers</h2>

<ul>
    <?php foreach ($profiles as $profile): ?>
        <li><a href="<?php echo url_for('profile_show_user', array('profile_name'=>$profile->getProfileName())) ?>"><?php echo $profile->getFullName() ?></a></li>
    <?php endforeach; ?>
</ul>

<h2>Rides</h2>