window.onload = function () {
    // to apply placeholder on date fields
    dateFieldCustomStyling();

    console.log(formatDate(new Date()));
}


function dateFieldCustomStyling() {
    let inputFields = document.querySelectorAll('input.date');
    
    if (inputFields.length) {
        let inputs = Array.from(inputFields);

        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.type = "date";
            });

            input.addEventListener('blur', function () {
                this.type = "text";
            });
        });
    }
}

/**
 * Lowercase format and single letter means no zeros for month and day and only last two digit of the year
 * Uppercase is the opposite of the lowercase format. day and month with zeros (if one digit) and complete years
 * 
 * @param {*} date 
 * @param {*} format 
 * 
 * @return {string}
 */
function formatDate(date, format="m/d/y h:i:s") {
    let d = new Date(date);
    let day = d.getDate();
    let month = d.getMonth() + 1;
    let year = d.getFullYear();

    let exp_frmt = format.split(/[^A-Za-z]+/);

    exp_frmt.forEach((v, i) => {
        console.log(isLowerCase(v), isUpperCase(v));
    });

    return exp_frmt;
}


/**
 * Check if string is all lowercase
 * 
 * @param {*} str 
 * @returns {boolean}
 */
function isLowerCase(str) {
    return str == str.toLowerCase();
}

/**
 * Check if string is all uppercase
 * 
 * @param {*} str 
 * @returns 
 */
function isUpperCase(str) {
    return str == str.toUpperCase();
}