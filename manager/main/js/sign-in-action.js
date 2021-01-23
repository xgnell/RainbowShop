const display_error_email_or_phone = document.getElementById('display-error-email-or-phone');
const display_error_password = document.getElementById('display-error-passwd');

function validate_email_or_phone() {
    const input_email_phone = document.getElementById('input-email-or-phone').value;

    if (input_email_phone.length === 0) {
        display_error_email_or_phone.textContent = "* Email hoặc số điện thoại không được để trống";
        return false;
    }

    const regex_form = /^((0[0-9]{9,9})|(([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+))$/;
    if (!regex_form.test(input_email_phone)) {
        display_error_email_or_phone.textContent = "* Email hoặc số điện thoại không hợp lệ";
        return false;
    }

    display_error_email_or_phone.textContent = "";
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

function admin_sign_in_form_validate(event) {
    event.preventDefault();
    if (validate_email_or_phone() & validate_password()) {
        document.querySelector('#admin-sign-in-form form').submit();
    }
}