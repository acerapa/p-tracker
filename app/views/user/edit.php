<?php 
    $title = 'Edit User';
    $BASE_PATH = dirname(__DIR__);
    // $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- header content -->
<?php ob_start()?>
    <?php include($BASE_PATH.'/layout/parts/header.php')?>
    <link rel="stylesheet" href="../../../app/Public/css/components/header.css">
    <link rel="stylesheet" href="../../../app/Public/css/user.css">
    <script src="../../../app/Public/js/components/header.js"></script>
<?php
    $header = ob_get_contents();
    ob_end_clean();
?>


<!-- body content -->
<?php ob_start();?>
    <div class="app-container">
        <!-- nav header -->
        <?php include($BASE_PATH.'/components/header.php')?>
        <!-- breadcrumbs -->
        <?php include($BASE_PATH.'/components/breadcrumbs.php')?>

        <div class="profile-image-wrapper">
            <img class="user-icon user-profile-img" src="../../../app/Public/icons/user.png" alt="" srcset="">
            <button class="button edit-user-btn">Edit User</button>
        </div>
        <br>
        <form action="/profile/update" method="post">
            <div class="form-group">
                <img src="../../../app/Public/icons/user-circle.png" class="edit-form-icons" alt="">
                <input type="text" class="input" name="username" placeholder="Username" value="<?php echo $user->username ?>">
            </div>
            <div class="form-group">
                <img src="../../../app/Public/icons/user-circle.png" class="edit-form-icons" alt="">
                <input type="text" class="input" name="first_name" placeholder="First name" value="<?php echo $user->first_name ?>">
            </div>
            <div class="form-group">
                <img src="../../../app/Public/icons/user-circle.png" class="edit-form-icons" alt="">
                <input type="text" class="input" name="last_name" placeholder="Last name" value="<?php echo $user->last_name ?>">
            </div>
            <div class="form-group">
                <img src="../../../app/Public/icons/email-2.png" class="edit-form-icons" alt="">
                <input type="email" class="input" name="email" placeholder="Email" value="<?php echo $user->email ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="button save-changes">Save Changes</button>
                <button type="button" class="button cancel">Cancel</button>
            </div>
        </form>    
    </div>
<?php
    $body = ob_get_contents();
    ob_end_clean();
?>

<?php 
    include($BASE_PATH.'/layout/app.php')
?>