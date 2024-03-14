window.onload = function () {
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
        });
    });
}