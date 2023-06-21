<?php
    $title = 'Home';
    $BASE_PATH = __DIR__;
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- header content -->
<?php ob_start()?>


<?php include($BASE_PATH.'/layout/parts/header.php')?>
<link rel="stylesheet" href="../../../app/Public/css/home.css">

<?php
    $header = ob_get_contents();
    ob_end_clean();
?>



<!-- body content -->
<?php ob_start()?>
    <div class="header">
        <img class="header-icon" src="../../app/Public/icons/logo.png" alt="logo" srcset="">
        <img class="header-icon user-icon" src="../../app/Public/icons/user.png" alt="user">
    </div>
    <div class="app-container">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus repellat fugiat deleniti. Nemo adipisci, distinctio obcaecati id nostrum recusandae, non numquam quis animi, vel molestias aliquid aut saepe possimus suscipit?
    </div>
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
