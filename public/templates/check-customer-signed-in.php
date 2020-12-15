<?php
session_start();
function check_customer_signed_in() {
    if (!customer_signed_in()) {
        ?>
        <h1>You must sign in first</h1>
        <a href="/manager/main/sign-in.php">Sign in</a>
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
