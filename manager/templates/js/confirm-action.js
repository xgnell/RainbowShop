function confirm_action(message, path) {
    if (confirm(message)) {
        goto_path(path);
    }
}

// Hàm này để chống copy link bằng chuột phải
function goto_path(path) {
    window.location.href = path;
}