<div class="flex flex-col max-w-[228px]">
    <div class="flex gap-[10px] items-center">
        <div class="w-[30px] h-[30px] flex items-center justify-center">
            <img src="<?php echo asset('img/', 'baby.jpg')?>" class="w-[30px] h-[30px] object-fit-cover rounded-full" alt="profile">
        </div>
        <!-- <p class="font-bold text-sm">Rynn Harvey</p> -->
        <p class="font-bold text-sm"><?php echo $user->username; ?></p>
        <img src="<?php echo asset('icons/', 'setting.png') ?>" class="w-5 h-5 mt-1">
        <img src="<?php echo asset('icons/', 'bell.png') ?>" class="w-5 h-5 mt-1">
    </div>
    <div class="flex flex-col gap-4 mt-[25px] w-[228px]">
        <a
            href="<?php echo route('app.dashboard'); ?>"
            class="rounded-l-4 py-[15px] pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'app.dashboard' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'dashboard.png'); ?>" class="w-5 h-5" alt="dashboard">
            <p class="text-sm font-semibold">Dashboard</p>
        </a>
        <a
            href="<?php echo route('income.index'); ?>"
            class="rounded-l-4 py-[11px] pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'income.index' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'income.png'); ?>" class="w-[27px] h-[28px]" alt="income">
            <p class="text-sm font-semibold">Income</p>
        </a>
        <a
            href="<?php echo route('expense.index'); ?>"
            class="rounded-l-4 py-[10px] pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'expense.index' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'money-transaction.png'); ?>" class="w-[30px] h-[30px]" alt="expense">
            <p class="text-sm font-semibold">Expense</p>
        </a>
        <a
            href="<?php echo route('budgeting.index'); ?>"
            class="rounded-l-4 py-[14_5px] pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'budgeting.index' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'budget.png'); ?>" class="w-[21px] h-[21px]" alt="budgeting">
            <p class="text-sm font-semibold">Budgeting</p>
        </a>
        <a
            href="<?php echo route('app.mycalendar'); ?>"
            class="rounded-l-4 py-3 pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'app.mycalendar' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'calendar.png'); ?>" class="w-[26px] h-[26px]" alt="my-calendar">
            <p class="text-sm font-semibold">My Calendar</p>
        </a>
        <a
            href="<?php echo route('app.todolist'); ?>"
            class="rounded-l-4 py-3 pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'app.todolist' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'checklist.png'); ?>" class="w-[25px] h-[25px]" alt="todolist">
            <p class="text-sm font-semibold">Todo List</p>
        </a>
        <a
            href="<?php echo route('app.notes'); ?>"
            class="rounded-l-4 py-3 pl-5 flex items-center gap-2 <?php echo isset($route) && $route['name'] == 'app.notes' ? 'active-nav' : '' ?>"
        >
            <img src="<?php echo asset('icons/', 'sticky-note.png'); ?>" class="w-[23px] h-[22px]" alt="notes">
            <p class="text-sm font-semibold">Notes</p>
        </a>
    </div>
</div>