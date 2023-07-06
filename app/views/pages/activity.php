<?php
    $title = 'Activity';
    $BASE_PATH = dirname(__DIR__);
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- header content -->
<?php ob_start()?>
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

    <!-- avtivities -->
    <div class="pending-todos">
        <div>
            <a href="<?php echo route('todo.index'); ?>" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="../../../app/Public/icons/task-list.png" alt="Verfied">
                <br>
                Todos
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="../../../app/Public/icons/budget.png" alt="Target">
                <br>
                Expense Tracker
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="../../../app/Public/icons/coming-soon.png" alt="Coming Soon">
                <br>
                Coming Soon
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="../../../app/Public/icons/coming-soon.png" alt="Coming Soon">
                <br>
                Coming Soon
            </a>
        </div>
    </div>
</div>

<?php
    $body = ob_get_contents();
    ob_end_clean();

    include($BASE_PATH.'/layout/app.php');
?>
