<?php slot(
  'title',
  sprintf('Rootless Me - Share your ride.'))
?>

<h1>Welcome to Rootless.Me</h1>
<div>
    <h2>Get out!</h2>
    <p>
        Rootless is a new kind of social network. One that exists only
        to help you get out from behind your computer and enjoy life.
    </p>
    <p>
        With rootless, you can easily find a ride anywhere you want,
        with people you like.
    </p>
    <div id="loginFormContainer">
        <h2>Log in</h2>
        <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $signinForm)) ?>
    </div>
    <div id="loginFormContainer">
        <h2>Join now</h2>
        <?php echo get_partial('sfGuardRegister/form', array('form' => $registerForm)) ?>
    </div>
</div>