const display_error_email = document.getElementById('display-error-email');
const display_error_password = document.getElementById('display-error-passwd');

function validate_email() {
    const input_email = document.getElementById('input-email').value;

    if (input_email.length === 0) {
        display_error_email.textContent = "* Email không được để trống";
        return false;
    }

    const regex_form = /^((0[0-9]{9,9})|(([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+))$/;
    if (!regex_form.test(input_email)) {
        display_error_email.textContent = "* Email không hợp lệ";
        return false;
    }

    display_error_email.textContent = "";
    return true;
}

function validate_password() {
    const input_password = document.getElementById('input-passwd').value;

    if (input_password.length === 0) {
        display_error_password.textContent = "* Mật khẩu không được để trống";
        return false;
    }

    display_error_password.textContent = "";
    return true;
}

function customer_sign_in_form_validate(event) {
    event.preventDefault();
    if (validate_email() & validate_password()) {
        document.querySelector('#sign-in-form form').submit();
    }
}