<!DOCTYPE html>
<html lang="en">
<?php 
    $title = 'Login';
    $imports = [
        'css' => '../../public/css/login.css'
    ];
    include(dirname(__DIR__)."/component/header.php")
?>
<body>
    <div class="login-container">
        <div>
            <img class="p-logo" src="../../public/icons/logo.png" alt="logo">
            <span class="sign-in-text">Sign in to <b>P-tracker</b></span>
            <form action="" method="post">
                <input class="input email-input" type="email" placeholder="Email" name="email" id="">
                <input class="input" type="password" placeholder="Password" name="password" id="">
                <input class="button" type="submit" value="Sign in">
            </form>
        </div>
    </div>
</body>
</html>