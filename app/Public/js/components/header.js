window.onload = function () {
    let rightSideBar = document.getElementById('header-dropdown');
    let userIcon = document.getElementById('user-icon');
    let dropdownClose = document.getElementById('dropdown-close');

    console.log(rightSideBar);
    console.log(userIcon);
    console.log(dropdownClose);

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

    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM loaded');
    });
}
