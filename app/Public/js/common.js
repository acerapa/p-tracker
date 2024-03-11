/**
 * Hide or show the modal depending on the state
 * 
 * @param {*} modalId modal element id
 * @param {*} state eiter "show" or "hide" case sensitive NOTE: if the item provided is not in the choice will result in warning
 */
function hideAndShowModal(modalId, state) {
    let modal = document.getElementById(modalId);
    let modalOverlay = document.getElementsByClassName('modal-overlay');

    if (state == 'show') {
        modalOverlay[0].classList.remove('hidden');
        modal.classList.remove('hidden');
        modalOverlay[0].classList.remove('block');
        modal.classList.remove('block');
    } else if (state == 'hide') {
        modalOverlay[0].classList.remove('block');
        modal.classList.remove('block');
        modalOverlay[0].classList.remove('hidden');
        modal.classList.remove('hidden');
    } else {
        console.warn(`hideAndShowModal: ${state} is not a valid state, choices are only (show, hide)`);
    }
}
