function remove_ascent (name) {
    if (name === null || name === undefined) return name;
    name = name.toLowerCase();
    name = name.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    name = name.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    name = name.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    name = name.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    name = name.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    name = name.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    name = name.replace(/đ/g, "d");
    return name;
}

function display_error(obj, which_error, message) {
    if (message !== '') {
        obj.classList.add('have-error');
    } else {
        obj.classList.remove('have-error');
    }
    which_error.textContent = message;
}

/* Kiểm tra trống */
function is_not_blank(input, which_error) {
    if (input.value.length === 0) {
        display_error(input, which_error, 'Không được để trống');
        return false;
    }
    return true;
}

/* Kiểm tra regex */
function is_pass_regex(input, which_error, regex_pattern, message) {
    if (!regex_pattern.test(input.value)) {
        display_error(input, which_error, message);
        return false;
    }
    return true;
}

function is_valid_input(type, regex, message) {
    let input = document.getElementById(`input-${type}`);
    let error = document.getElementById(`display-error-${type}`);

    if (!is_not_blank(input, error)) return false;
    if (!is_pass_regex(input, error, regex, message)) return false;

    display_error(input, error, '');
    return true;
}

function is_valid_select(type) {
    let select = document.getElementById(`select-${type}`);
    let error = document.getElementById(`display-error-${type}`);

    if (select.value === '') {
        display_error(select, error, 'Không được để trống, phải lựa chọn');
        return false;
    }

    display_error(select, error, '');
    return true;
}



function is_valid_name(regex, message) {
    let input = document.getElementById(`input-name`);
    let input_data = input.value;
    let error = document.getElementById(`display-error-name`);

    if (!is_not_blank(input, error)) return false;

    /* Kiểm tra regex */
    input_data = remove_ascent(input_data);
    if (!regex.test(input_data)) {
        display_error(input, error, message);
        return false;
    }

    display_error(input, error, '');
    return true;
}

function is_valid_password(check_power) {
    let input = document.getElementById(`input-passwd`);
    let input_data = input.value;
    let error = document.getElementById(`display-error-passwd`);

    if (!is_not_blank(input, error)) return false;

    // Kiểm tra các kí tự đặc biệt của mật khẩu
    if ((/(\'|\"|\#|\;|\ )/).test(input_data)) {
        display_error(input, error, 'Mật khẩu chứa các kí tự không hợp lệ: "\'", "\"", ";", "#", khoảng trắng');
        return false;
    }

    // Kiểm tra độ mạnh mật khẩu
    if (check_power) {
        // if (input_data.length < 8) {
        //     display_error(error, 'Mật khẩu không đủ mạnh (Tối thiểu 8 kí tự)');
        //     return false;
        // }

        // if (
        //     (/[a-z]/g).test(input_data) &&
        //     (/[A-Z]/g).test(input_data) &&
        //     (/[0-9]/g).test(input_data)
        // ) {
        //     // Mật khẩu đủ mạnh
        // }
        // else {
        //     display_error(error, 'Mật khẩu không đủ mạnh (Phải chứa cả số và chữ)');
        //     return false;
        // }
        if (!(/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})/).test(input_data)) {
            display_error(input, error, 'Mật khẩu không đủ mạnh (Phải chứa ít nhất 8 kí tự, bao gồm cả số, chữ và các kí tự đặc biệt được cho phép)');
            return false;
        }
    }

    display_error(input, error, '');
    console.log('Pass here');
    return true;
}


function is_valid_birth() {
    let select_day = document.getElementById(`select-day`);
    let select_month = document.getElementById(`select-month`);
    let select_year = document.getElementById(`select-year`);

    let error = document.getElementById(`display-error-birth`);

    let error_message = '';
    let is_passed = true;

    if (select_day.value === '') {
        error_message += 'Ngày ';
        select_day.classList.add('have-error');
        is_passed = false;
    } else {
        select_day.classList.remove('have-error');
    }

    if (select_month.value === '') {
        error_message += 'Tháng ';
        select_month.classList.add('have-error');
        is_passed = false;
    } else {
        select_month.classList.remove('have-error');
    }

    if (select_year.value === '') {
        error_message += 'Năm ';
        select_year.classList.add('have-error');
        is_passed = false;
    } else {
        select_year.classList.remove('have-error');
    }

    if (!is_passed) {
        error.textContent = `${error_message}không được để trống, phải lựa chọn`;
        return false;
    }

    error.textContent = '';
    return true;
}


// Hàm validate chính
function validate_all(regex_list, select_list) {
    let is_passed = true;

    if ('name' in regex_list) {
        if (!is_valid_name(
            regex_list['name'][0],
            regex_list['name'][1])
        ) {
            if (is_passed == true) is_passed = false;
        }
    }

    if ('passwd' in regex_list) {
        if (!is_valid_password(regex_list['passwd'])) {
            if (is_passed == true) is_passed = false;
        }
    }

    for (const [name, data] of Object.entries(regex_list)) {
        if (name != 'name' && name != 'passwd') {
            const [regex, message] = data;
            if (!is_valid_input(name, regex, message)) {
                if (is_passed == true) is_passed = false;
            }
        }
    }

    if (select_list.includes('birth')) {
        if (!is_valid_birth()) {
            if (is_passed == true) is_passed = false;
        }
    }

    for (const name of select_list) {
        if (name != 'birth') {
            if (!is_valid_select(name)) {
                if (is_passed == true) is_passed = false;
            }
        }
    }

    return is_passed;
}