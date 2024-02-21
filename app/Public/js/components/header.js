window.onload = function () {
    let rightSideBar = document.getElementById('header-dropdown');
    let userIcon = document.getElementById('user-icon');
    let dropdownClose = document.getElementById('dropdown-close');

    // event listeners
    userIcon.addEventListener('click', function () {
        console.log('clicked');
        rightSideBar.classList.remove('slideOutRight');
        rightSideBar.classList.add('slideInRight');
    });

    dropdownClose.addEventListener('click', function () {
        rightSideBar.classList.remove('slideInRight');
        rightSideBar.classList.add('slideOutRight');
    });
}
