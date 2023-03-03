<!DOCTYPE html>
<html lang="en">
<?php 
    $title = 'Login';
    $imports = [
        'css' => '../../../app/Public/css/login.css'
    ];
    include(dirname(__DIR__)."/component/header.php")
?>
<body>
    <div class="login-container">
        <div>
            <img class="p-logo" src="../../../app/Public/icons/logo.png" alt="logo">
            <span class="sign-in-text">Sign in to <b>P-tracker</b></span>
            <form action="" method="post">
                <input class="input email-input" type="email" placeholder="Email" name="email" autocomplete="off">
                <input class="input" type="password" placeholder="Password" name="password">
                <input class="button" type="submit" value="Sign in">
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
            <div class="forgot-cont">
                <a href="#" class="forgot-pass">Forgot password?</a>
            </div>
            <p style="margin-top: 22px;">Don't have account yet? <b><a href="/register">Sign up</a></b></p>
        </div>
    </div>
</body>
</html>