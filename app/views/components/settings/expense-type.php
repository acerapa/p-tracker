<?php
$data = $expense_types;
?>

<div class="mt-5 flex flex-col gap-3">
    <div class="flex gap-3 items-center">
        <p class="settings-title">Expense Type</p>
        <button type="button" class="btn bg-lightly-dark-blue btn-plus w-[30px] h-[30px] create-expense-type-modal" />
    </div>
    <div class="w-full mt-5 expense-type-table">
        <div class="grid grid-cols-3 bg-lightly-dark-blue text-white rounded-t-[10px] px-7 py-2">
            <p class="col-span-1 font-semibold text-sm">#ID</p>
            <p class="col-span-1 font-semibold text-sm">NAME</p>
            <p class="col-span-1 font-semibold text-sm">ACTION</p>
        </div>

        <div class="table-strip">
            <?php foreach ($data as $type): ?>
            <div class="grid grid-cols-3 px-7 py-2 items-center">
                <p class="col-span-1 font-normal text-sm">#<?php echo $type->id; ?></p>
                <p class="col-span-1 font-normal text-sm"><?php echo $type->name; ?></p>
                <div class="col-span-1 font-normal text-sm">
                    <button class="btn bg-lightly-dark-blue w-[30px] h-[30px] relative">
                        <img class="w-5 absolute top-1/2 left-1/2 -translate-1/2" src="<?php echo asset('img/', 'info.png') ?>" alt="info.png">
                    </button>
                    <button class="btn bg-lightly-dark-blue w-[30px] h-[30px] relative delete-modal-trigger" data-id="<?php echo $type->id ?>" data-href="<?php echo route('settings.destroy')?>">
                        <img class="w-5 absolute top-1/2 left-1/2 -translate-1/2" src="<?php echo asset('img/', 'remove.png') ?>" alt="remove.png">
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="<?php echo asset('js/specifics/', 'expense.js') ?>"></script>