const display_error_email_sign_in = document.getElementById('display-error-email-sign-in');
const display_error_password_sign_in = document.getElementById('display-error-passwd-sign-in');

function validate_email() {
    const input_email = document.getElementById('input-email-sign-in').value;

    if (input_email.length === 0) {
        display_error_email_sign_in.textContent = "* Email không được để trống";
        return false;
    }

    const regex_form = /^((0[0-9]{9,9})|(([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+))$/;
    if (!regex_form.test(input_email)) {
        display_error_email_sign_in.textContent = "* Email không hợp lệ";
        return false;
    }

    display_error_email_sign_in.textContent = "";
    return true;
}

function validate_password() {
    const input_password = document.getElementById('input-passwd-sign-in').value;

    if (input_password.length === 0) {
        display_error_password_sign_in.textContent = "* Mật khẩu không được để trống";
        return false;
    }

    display_error_password_sign_in.textContent = "";
    return true;
}

function customer_sign_in_form_validate(event) {
    event.preventDefault();
    if (validate_email() & validate_password()) {
        document.querySelector('#sign-in-form form').submit();
    }
}