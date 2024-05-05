<?php
$title = 'Settings';
$BASE_PATH = base_path();
$user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;

?>

<!-- body content -->
<?php ob_start() ?>
<!-- Expense type modal -->
<div class="modal hidden" id="expense-type-modal">
    <form action="<?php echo route('settings.addexpensetype')?>" method="POST">
        <div class="flex justify-between items-center">
            <p class="text-base font-bold">New Expense Type</p>
            <img class="w-5 h-5 cursor-pointer close-expense-type-modal" src="<?php echo asset('img/', 'cancel.png'); ?>" alt="cancel">
        </div>
        <div class="flex flex-col gap-[34px]">
            <div class="flex gap-[30px] mt-[18px] w-full">
                <div class="flex flex-col gap-1 flex-1">
                    <label for="amount" class="text-blue text-sm font-normal">Name</label>
                    <input type="text" placeholder="Name" name="name" id="name" class="!max-w-full input">
                </div>
            </div>
            <div class="flex gap-[14px] justify-center">
                <button type="button" class="btn btn-outline close-expense-type-modal">Cancel</button>
                <button class="btn bg-lightly-dark-blue">Save</button>
            </div>
        </div>
    </form>
</div>

<div class="main-container">
    <div class="w-full grid grid-[auto_1fr] h-full">
        <?php include($BASE_PATH . "/views/components/side-nav.php"); ?>
        <div class="main-content">
            <p class="title"><?php echo $title; ?></p>

            <div class="content p-6 mt-[25px] rounded-t-[10px] h-full">
                <!-- get tabs -->
                <?php include($BASE_PATH . "/views/components/settings/tabs.php"); ?>

                <?php use_component('settings/expense-type', '', compact('expense_types')) ?>
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