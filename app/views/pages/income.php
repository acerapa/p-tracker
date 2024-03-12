<?php
$title = 'Income';
$BASE_PATH = base_path();
$user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
$data = [];
?>

<!-- body content -->
<?php ob_start() ?>
<div class="modal-overlay hidden"></div>
<div class="modal hidden" id="income-modal">
    <div class="flex justify-between items-center">
        <p class="text-base font-bold">Add Income</p>
        <img class="w-5 h-5 close-income-modal cursor-pointer" src="<?php echo asset('img/', 'cancel.png'); ?>" alt="cancel">
    </div>
</div>

<div class="main-container">
    <div class="w-full grid grid-[auto_1fr] h-full">
        <?php include($BASE_PATH."/views/components/side-nav.php"); ?>
        <div class="main-content">
            <p class="title"><?php echo $title; ?></p>

            <div class="content p-6 mt-[25px] rounded-t-[10px] h-full">
                <div class="flex justify-between items-center">
                    <p class="text-base font-meduim">All data</p>
                    <div class="flex gap-3 items-center">
                        <input type="number" placeholder="Amount" class="input min-w-[140px]">
                        <input type="text" placeholder="From" class="input min-w-[140px] h-[14-5px] date">
                        <input type="text" placeholder="To" class="input min-w-[140px] h-[14-5px] date">
                        <button class="btn bg-lightly-dark-blue">Search</button>
                        <button class="btn bg-lightly-dark-blue btn-plus w-[30px] h-[30px] create-income-modal" />
                    </div>
                </div>

                <div class="w-full mt-5 income-table">
                    <div class="grid grid-cols-7 bg-lightly-dark-blue text-white rounded-t-[10px] px-7 py-2">
                        <p class="col-span-1 font-semibold text-sm">#ID</p>
                        <p class="col-span-1 font-semibold text-sm">WHEN</p>
                        <p class="col-span-3 font-semibold text-sm">DESCRIPTION</p>
                        <p class="col-span-1 font-semibold text-sm">AMOUNT</p>
                        <p class="col-span-1 font-semibold text-sm">ACTION</p>
                    </div>
                    <div class="m-w-[584px]">
                        <?php if (count($data) <= 0): ?>
                            <div class="table-no-data flex justify-center">
                                <div class="relative">
                                    <img src="<?php echo asset('img/', 'no-data.png'); ?>" alt="no-data">
                                    <div class="flex flex-col gap-3 text-center absolute w-full bottom-3">
                                        <p class="text-normal font-bold">No data to be shown</p>
                                        <div>
                                            <button class="btn bg-lightly-dark-blue create-income-modal">Add Income</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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