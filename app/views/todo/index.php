<?php
    $BASE_PATH = dirname(__DIR__);
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
    $title = 'Todo';
?>

<!-- header content -->
<?php ob_start()?>
    <link rel="stylesheet" href="../../app/Public/css/components/header.css">
    <script src="../../app/Public/js/components/header.js"></script>
<?php
    $header = ob_get_contents();
    ob_end_clean();
?>

<!-- body content -->
<?php ob_start() ?>
    <div class="app-container">
        <!-- bread crumbs -->
        <?php include($BASE_PATH.'/components/breadcrumbs.php')?>
        <!-- main content -->
        <div class="welcome">
            Test
        </div>
        <div class="main-content">
           <h1>Todo List</h1>
           <ul>
            <li>Test</li>
            <li>Test</li>
            <li>Test</li>
            <li>Test</li>
            <li>Test</li>
            <li>Test</li>
           </ul>
        </div>
    </div>
<?php 
    $body = ob_get_contents();
    ob_end_clean();
?>

<?php include($BASE_PATH.'/layout/app.php') ?>