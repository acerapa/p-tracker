<?php
    $title = 'Home';
    $BASE_PATH = __DIR__;
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;

    $header="";
?>

<!-- body content -->
<?php ob_start()?>
    <div class="app-container">
        <!-- bread crumbs -->
        <?php include($BASE_PATH.'/components/breadcrumbs.php')?>

        <div class="welcome">
            <span class="welcome-text">Welcome <?php echo $user->username; ?></span><br>
            <small>Good Morning!</small>

            <img class="header-cloud-sun" src="<?php echo asset('icons/', 'cloud-sun.png')?>" alt="">
        </div>

        <div class="no-activity">
            No activity recently!
        </div>
    </div>
<?php
    $body = ob_get_contents();
    ob_end_clean();
    $footer="";
?>
