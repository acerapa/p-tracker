function initializeExpenseModals() {
    // show expense modal
    let expense_modal_triggers = document.querySelectorAll('.create-expense-modal');
    Array.from(expense_modal_triggers).forEach(trigger => {
        trigger.addEventListener('click', function () {
            hideAndShowModal('expense-modal', 'show');
        });
    });

    let expense_modal_closer = document.querySelectorAll('.close-expense-modal');
    Array.from(expense_modal_closer).forEach(closer => {
        closer.addEventListener('click', function () {
            hideAndShowModal('expense-modal', 'hide');
        });
    });
}

function initializedExpenseTypeModal() {
    let expense_type_modal_triggers = document.querySelectorAll('.create-expense-type-modal');
    Array.from(expense_type_modal_triggers).forEach(trigger => {
        trigger.addEventListener('click', function () {
            hideAndShowModal('expense-type-modal', 'show');
        });
    });

    let expense_type_modal_closer = document.querySelectorAll('.close-expense-type-modal');
    Array.from(expense_type_modal_closer).forEach(closer => {
        closer.addEventListener('click', function () {
            hideAndShowModal('expense-type-modal', 'hide');
        });
    });
}

initializeExpenseModals();
initializedExpenseTypeModal();