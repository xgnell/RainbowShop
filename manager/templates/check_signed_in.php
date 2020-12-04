<?php
session_start();
function check_admin_signed_in(int $rank) {
    if (!is_admin_signed_in()) {
        ?>
        <h1>You must sign in as admin to reach this page</h1>
        <a href="/manager/main/sign_in.php">Sign in</a>
        <button onclick="window.history.back()">Back</button>
        <?php
        die();
    } else if (!is_admin_rank($rank)) {
        ?>
        <h1>your rank isn't enough to enter this page</h1>
        <!-- <a href="/manager/main/sign_in.php">Sign in</a> -->
        <button onclick="window.history.back()">Back</button>
        <?php
        die();
    }
}
function is_admin_signed_in(): bool {
    if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") {
        return true;
    }
    return false;
}
function is_admin_rank(int $rank): bool {
    if (isset($_SESSION["rank"]) && $_SESSION["rank"] <= $rank) {
        return true;
    }
    return false;
}

function check_customer_signed_in() {
    if (!customer_signed_in()) {
        ?>
        <h1>You must sign in first</h1>
        <a href="/manager/main/sign_in.php">Sign in</a>
        <button onclick="window.history.back()">Back</button>
        <?php
        die();
    }
}
function customer_signed_in() {
    if (isset($_SESSION["type"]) && $_SESSION["type"] == "customer") {
        return true;
    }
    return false;
}
