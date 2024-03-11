window.onload = function () {
    // to apply placeholder on date fields
    dateFieldCustomStyling();

    console.log(formatDate(new Date(), "M/D/Y"));
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
function formatDate(date, format="m/d/y") {
    let d = new Date(date);
    
    let exp_frmt = format.split(/[^A-Za-z]+/);
    let final_frmt = format;
    exp_frmt.forEach(v => {
        if (isLowerCase(v)) {
            switch (v) {
                case 'm':
                    final_frmt = final_frmt.replaceAll(v, d.getMonth() + 1);
                    break;
                case 'd':
                    final_frmt = final_frmt.replaceAll(v, d.getDate());
                    break;
                case 'y':
                    final_frmt = final_frmt.replaceAll(v, d.getUTCFullYear().toString().slice(-2));
                    break;
            }
        } else if (isUpperCase(v)) {
            
        }
    });

    return final_frmt;
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
