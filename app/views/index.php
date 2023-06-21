<?php
    $title = 'Home';
    $BASE_PATH = __DIR__;
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>


<!-- header content -->
<?php ob_start()?>
    <?php include($BASE_PATH.'/layout/parts/header.php')?>
    <link rel="stylesheet" href="../../../app/Public/css/home.css">
    <script src="../../app/Public/js/home.js"></script>
<?php
    $header = ob_get_contents();
    ob_end_clean();
?>



<!-- body content -->
<?php ob_start()?>
    <div class="header">
        <div class="header-wrapper-icon">
            <img class="header-icon" src="../../app/Public/icons/logo.png" alt="logo" srcset="">
            <span class="app-name">P-tracker</span>
        </div>
        <div class="header-wrapper-user">
            <img class="header-icon user-icon" id="user-icon" src="../../app/Public/icons/user.png" alt="user">
        </div>

        <div class="header-dropdown" id="header-dropdown">
            <div class="user-profile">
                <img class="user-icon" src="../../app/Public/icons/user.png" alt="" srcset="">
                <small><?php echo $user->username; ?></small>
                <img class="header-dropdown-close" id="dropdown-close" src="../../app/Public/icons/close.png" alt="">
            </div>
            <div class="header-dropdown-wrapper">
                <div class="header-dropdown-item">
                    <a href="#" class="header-dropdown-link"><img src="../../app/Public/icons/user-circle.png" alt="">Profile</a>
                </div>
                <div class="header-dropdown-item">
                    <a href="#" class="header-dropdown-link"><img src="../../app/Public/icons/settings.png" alt="">Settings</a>
                </div>
                <div class="header-dropdown-item">
                    <a href="/logout" class="header-dropdown-link"><img src="../../app/Public/icons/logout.png" alt="">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-container">
        <!-- bread crumbs -->
        <div class="breadcrumbs">
            <a href="#" class="breadcrumbs-text">Home</a>
        </div>

        <div class="welcome">
            <span class="welcome-text">Welcome <?php echo $user->username; ?></span><br>
            <small>Good Morning!</small>

            <img class="header-cloud-sun" src="../../app/Public/icons/cloud-sun.png" alt="">
        </div>

        <div class="pending-todos">
            <span class="pending-title">Pending Todos</span>
        </div>
    </div>
<?php
    $body = ob_get_contents();
    ob_end_clean();
?>


<!-- footer content -->
<?php ob_start()?>
    <!-- <span>This is footer</span> -->
    <?php #include($BASE_PATH.'/layout/parts/footer.php')?>
<?php
    $footer = ob_get_contents();
    ob_end_clean();
?>


<!-- inclulde layout -->
<?php
    include($BASE_PATH.'/layout/app.php');
?>
