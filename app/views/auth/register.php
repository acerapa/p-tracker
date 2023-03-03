<!DOCTYPE html>
<html lang="en">
<?php 
    $title = 'Register';
    $imports = [
        'css' => '../../../app/Public/css/register.css'
    ];
    include(dirname(__DIR__)."/component/header.php")
?>
<body>
    <div class="register-container">
        <div>
            <img class="p-logo" src="../../../app/Public/icons/logo.png" alt="logo">
            <span class="sign-in-text">Sign in to <b>P-tracker</b></span>
            <form action="/user/add" method="post">
                <input class="input username-input" type="text" placeholder="Username" name="username" id="">
                <input class="input" type="email" placeholder="Email" name="email" id="">
                <input class="input" type="password" placeholder="Password" name="password" id="">
                <input class="input" type="password" placeholder="Confirm password" name="confirm-password" id="">
                <input class="button" type="submit" value="Sign up">
            </form>
            <p>or</p>

            <div class="social-media google-sign">
                <img class="social-icons google-icon" src="../../../app/Public/icons/google-icon.png" alt="google">
                <span><b>&nbsp;&nbsp;continue with google</b></span>
            </div>
            <div class="social-media facebook-sign">
                <img class="social-icons facebook-icon" src="../../../app/Public/icons/facebook-icon.png" alt="facebook">
                <span><b>&nbsp;&nbsp;continue with facebook</b></span>
            </div>
            <p style="margin-top: 22px;">Already had an account? <b><a href="/login">Sign in</a></b></p>
        </div>
    </div>
</body>
</html>