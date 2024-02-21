<?php
    $title = 'Activity';
    $BASE_PATH = dirname(__DIR__);
    $user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
?>

<!-- header content -->
<?php ob_start()?>
    <link rel="stylesheet" href="<?php echo asset('css/', 'activity.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/components/','header.css') ?>">
<?php 
    $header = ob_get_contents();
    ob_end_clean();
?>

<!-- body content -->
<?php ob_start()?>
<div class="app-container">
    <!-- bread crumbs -->
    <?php include($BASE_PATH.'/components/breadcrumbs.php')?>

    <!-- avtivities -->
    <div class="pending-todos">
        <div>
            <a href="<?php echo route('todo.index'); ?>" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="<?php echo asset('icons/', 'task-list.png'); ?>" alt="Verfied">
                <br>
                Todos
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="<?php echo asset('icons/', 'budget.png'); ?>" alt="Target">
                <br>
                Expense Tracker
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="<?php echo asset('icons/', 'coming-soon.png'); ?>" alt="Coming Soon">
                <br>
                Coming Soon
            </a>
        </div>
        <div>
            <a href="#" rel="noopener noreferrer">
                <img class="invert-color activity-icon" src="<?php echo asset('icons/', 'coming-soon.png'); ?>" alt="Coming Soon">
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
