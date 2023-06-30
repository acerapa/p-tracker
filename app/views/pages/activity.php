<?php
    $title = 'Activity';
    $BASE_PATH = dirname(__DIR__);
?>

<!-- header content -->
<?php ob_start()?>
    <?php include($BASE_PATH.'/layout/parts/header.php')?>
    <link rel="stylesheet" href="../../../app/Public/css/activity.css">
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
</div>

<?php
    $body = ob_get_contents();
    ob_end_clean();

    include($BASE_PATH.'/layout/app.php');
?>
