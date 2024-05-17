function initializeIncomeModals() {
    // show income modal
    let income_modal_triggers = document.querySelectorAll('.create-income-modal');
    Array.from(income_modal_triggers).forEach(trigger => {
        trigger.addEventListener('click', function () {
            hideAndShowModal('income-modal', 'show');
        });
    });

    let income_modal_closer = document.querySelectorAll('.close-income-modal');
    Array.from(income_modal_closer).forEach(closer => {
        closer.addEventListener('click', function () {
            hideAndShowModal('income-modal', 'hide');
            document.getElementById('income-modal')
                .querySelector('form')
                .reset();
            document.querySelector('.modal-title').innerHTML = 'Add Income';
            const income_form = document.getElementById('income-modal').querySelector('form');
            income_form.setAttribute('action', income_form.getAttribute('data-default-action'));
        });
    });
}

function initializecUpdateIncomeModal() {
    let update_income_modal_triggers = document.querySelectorAll('.update-income-modal');
    Array.from(update_income_modal_triggers).forEach(trigger => {
        trigger.addEventListener('click', function () {
            // update modal title
            document.querySelector('.modal-title').innerHTML = 'Update Income';

            const data = this.getAttribute('data-income');
            if (data) {
                const parsedData = JSON.parse(data);
                parsedData['href'] = this.getAttribute('data-href');
                populateFormData(parsedData);
                hideAndShowModal('income-modal', 'show');
            } else {
                console.warn('No data found!'); 
            }
        });
    });
}

function populateFormData(data) {
    const income_form = document.getElementById('income-modal').querySelector('form');
    const elements = income_form.elements;

    elements.when.value = formatDate(new Date(data['when']));
    elements.amount.value = data['amount'];
    elements.description.value = data['description'];
    elements.income_id.value = data['id'];

    income_form.setAttribute('action', data['href']);
}

initializeIncomeModals();
initializecUpdateIncomeModal();