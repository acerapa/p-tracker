window.onload = function () {
    // to apply placeholder on date fields
    dateFieldCustomStyling();

    // show income modal
    let income_modal_triggers = document.querySelectorAll('.create-income-modal');
    Array.from(income_modal_triggers).forEach(triger => {
        triger.addEventListener('click', function () {
            hideAndShowModal('income-modal', 'show');
        });
    });

    let income_modal_closer = document.querySelectorAll('.close-income-modal');
    Array.from(income_modal_closer).forEach(closer => {
        closer.addEventListener('click', function () {
            hideAndShowModal('income-modal', 'hide');
        });
    })

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
                this.value = formatDate(new Date(this.value));
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
                case 'mm':
                    let to_replace_m = d.getMonth() + 1;
                    if ('mm') {
                        to_replace_m = (d.getMonth() + 1).toString().length < 2 ? "0"+(d.getMonth() + 1) : d.getMonth() + 1;
                    }
                    final_frmt = final_frmt.replaceAll(v, to_replace_m);
                    break;
                case 'd':
                case 'dd':
                    let to_replace = d.getDate();
                    if ('dd') {
                        to_replace = d.getDate().toString().length < 2 ? "0"+d.getDate() : d.getDate();
                    }
                    final_frmt = final_frmt.replaceAll(v, to_replace);
                    break;
                case 'y':
                case 'yy':
                    final_frmt = final_frmt.replaceAll(v, d.getUTCFullYear().toString().slice(-2));
                    break;
            }
        } else if (isUpperCase(v)) {
            // code here
            // TODO: Need to update this code for now it's only returning the same as above code.
            switch (v) {
                case 'M':
                case 'mm':
                    final_frmt = final_frmt.replaceAll(v, d.getMonth() + 1);
                    break;
                case 'D':
                case 'DD':
                    final_frmt = final_frmt.replaceAll(v, d.getDate());
                    break;
                case 'Y':
                    final_frmt = final_frmt.replaceAll(v, d.getUTCFullYear());
                    break;
            }
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
