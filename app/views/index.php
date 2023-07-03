<?php
    $title = 'Home';
    $BASE_PATH = __DIR__;
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>


<!-- header content -->
<?php ob_start()?>
    <?php include($BASE_PATH.'/layout/parts/header.php')?>
    <link rel="stylesheet" href="../../../app/Public/css/home.css">
    <link rel="stylesheet" href="../../app/Public/css/components/header.css">
    <script src="../../app/Public/js/components/header.js"></script>
<?php
    $header = ob_get_contents();
    ob_end_clean();
?>



<!-- body content -->
<?php ob_start()?>
    <div class="app-container">
        <!-- nav header -->
        <?php include($BASE_PATH.'/components/header.php')?>
        <!-- bread crumbs -->
        <?php include($BASE_PATH.'/components/breadcrumbs.php')?>

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
