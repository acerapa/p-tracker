<?php
$title = 'Income';
$BASE_PATH = base_path();
$user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- body content -->
<?php ob_start() ?>
<div class="main-container">
    <div class="w-full grid grid-[auto_1fr] h-full">
        <?php include($BASE_PATH."/views/components/side-nav.php"); ?>
        <div class="main-content">
            <p class="title"><?php echo $title; ?></p>

            <div class="content p-6 mt-[25px] rounded-t-[10px] h-full">
                <h1><?php echo $route['name'];  ?></h1>
            </div>
        </div>
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