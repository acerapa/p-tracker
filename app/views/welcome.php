<?php
    $BASE_PATH = __DIR__;
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- header content -->
<?php ob_start()?>
<h4>This is header</h4>
<?php
    $header = ob_get_contents();
    ob_end_clean();
?>

<!-- body content -->
<?php ob_start()?>
    <p>This is body</p>
<?php 
    $body = ob_get_contents();
    ob_end_clean();
?>

<!-- footer content -->
<?php ob_start()?>
    <span>This is footer</span>
    <?php include($BASE_PATH.'/layout/parts/footer.php')?>
<?php
    $footer = ob_get_contents();
    ob_end_clean();
?>

<!-- inclulde layout -->
<?php
    include($BASE_PATH.'/layout/app.php');
?>
