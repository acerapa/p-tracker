<?php
$title = 'Income';
$BASE_PATH = base_path();
$user = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
$data = $incomes;
?>

<!-- body content -->
<?php ob_start() ?>
<div class="modal hidden" id="income-modal">
    <form action="<?php echo route('income.create')?>" method="POST">
        <div class="flex justify-between items-center">
            <p class="text-base font-bold">Add Income</p>
            <img class="w-5 h-5 cursor-pointer close-income-modal" src="<?php echo asset('img/', 'cancel.png'); ?>" alt="cancel">
        </div>
        <div class="flex flex-col gap-[34px]">
            <div class="flex gap-[30px] mt-[18px] w-full">
                <div class="flex flex-col gap-1 flex-1">
                    <label for="amount" class="text-blue text-sm font-normal">Amount</label>
                    <input type="number" placeholder="Amount" name="amount" id="amount" class="!max-w-full input">
                </div>
                <div class="flex flex-col gap-1 flex-1">
                    <label for="when" class="text-blue text-sm font-normal">When</label>
                    <input type="text" placeholder="Date" name="when" id="when" class="!max-w-full input date">
                </div>
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="description" class="text-blue text-sm font-normal">Description</label>
                <textarea name="description" id="" col="100" rows="10" class="input !max-w-full" placeholder="Description"></textarea>
            </div>
            <div class="flex gap-[14px] justify-center">
                <button type="button" class="btn btn-outline close-income-modal">Cancel</button>
                <button class="btn bg-lightly-dark-blue">Save</button>
            </div>
        </div>
    </form>
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

                    <div class="table-strip">
                        <?php foreach ($data as $income): ?>
                            <div class="grid grid-cols-7 px-7 py-2 items-center">
                                <p class="col-span-1 font-normal text-sm"><?php echo $income->id ?></p>
                                <p class="col-span-1 font-normal text-sm"><?php echo $income->when ?></p>
                                <p class="col-span-3 font-normal text-sm"><?php echo $income->description ?></p>
                                <p class="col-span-1 font-normal text-sm">Php <?php echo $income->amount ?></p>
                                <div class="col-span-1 font-normal text-sm">
                                    <button class="btn bg-lightly-dark-blue w-[30px] h-[30px] relative">
                                        <img class="w-5 absolute top-1/2 left-1/2 -translate-1/2" src="<?php echo asset('img/', 'info.png') ?>" alt="info.png">
                                    </button>
                                    <button class="btn bg-lightly-dark-blue w-[30px] h-[30px] relative">
                                        <img class="w-5 absolute top-1/2 left-1/2 -translate-1/2 delete-modal-trigger" src="<?php echo asset('img/', 'remove.png') ?>" alt="remove.png">
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
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

<?php ob_start() ?>
<script src="<?php echo asset('js/specifics/', 'income.js') ?>"></script>
<?php
$scripts = ob_get_contents();
ob_end_clean();
?>

<!-- inclulde layout -->
<?php
$defined_vars = get_defined_vars();
use_layout('layout', $defined_vars, 'layout');
?>