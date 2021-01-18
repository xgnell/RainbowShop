<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// session_start();
function check_admin_signed_in(int $level) {
    if (!is_admin_signed_in()) {
        ?>
        <h1>Bạn phải đăng nhập với quyền admin để truy cập</h1>
        <a href="/manager/main/sign-in.php">Sign in</a>
        <button onclick="window.history.back()">Back</button>
        <?php
        die();
    } else if (!is_admin_rank($level)) {
        ?>
        <h1>Bạn không đủ quyền hạn để truy cập</h1>
        <!-- <a href="/manager/main/sign_in.php">Sign in</a> -->
        <button onclick="window.history.back()">Back</button>
        <?php
        die();
    }
}
function is_admin_signed_in(): bool {
    if (isset($_SESSION["user"]) && $_SESSION["user"]["type"] == "admin") {
        return true;
    }
    return false;
}
function is_admin_rank(int $level): bool {
    if (isset($_SESSION["user"]["admin"]["rank"]) && $_SESSION["user"]["admin"]["rank"]["level"] <= $level) {
        return true;
    }
    return false;
}