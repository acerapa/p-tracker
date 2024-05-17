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
            document.querySelector('.modal-title').innerHTML = 'Add Expense';
            const form = document.getElementById('expense-modal').querySelector('form');
            form.setAttribute('action', form.getAttribute('data-default-action'));
            form.reset();
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

function initializedExpenseUpdateModal() {
    let expense_update_modal_triggers = document.querySelectorAll('.update-expense-modal');
    Array.from(expense_update_modal_triggers).forEach(trigger => {
        trigger.addEventListener('click', function () {
            // update modal title
            document.querySelector('.modal-title').innerHTML = 'Update Expense';

            const data = this.getAttribute('data-expense');
            if (data) {
                const parsedData = JSON.parse(data);
                parsedData['href'] = this.getAttribute('data-href');
                populateFormData(parsedData)
                hideAndShowModal('expense-modal', 'show');
            } else {
                console.warn('No data found!');
            }
        })
    })
}

function populateFormData(data) {
    const expense_form = document.getElementById('expense-modal').querySelector('form')
    const elements = expense_form.elements;

    elements.amount.value = data['amount'];
    elements.when.value = formatDate(new Date(data['when']));
    elements.description.value = data['description'];
    elements.expense_id.value = data['id'];

    expense_form.setAttribute('action', data['href']);
}

initializeExpenseModals();
initializedExpenseTypeModal();
initializedExpenseUpdateModal();