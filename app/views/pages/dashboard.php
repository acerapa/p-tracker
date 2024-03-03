<?php
$title = 'Dashboard';
$BASE_PATH = base_path();
$user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- body content -->
<?php ob_start() ?>
<div class="main-container">
    <div class="w-full grid grid-[auto_1fr]">
        <?php include($BASE_PATH."/views/components/side-nav.php"); ?>
    </div>
</div>
<?php
$body = ob_get_contents();
ob_end_clean();
?>

<!-- inclulde layout -->
<?php
$defined_vars = get_defined_vars();
use_layout('layout', $defined_vars, 'layout');
?>