<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/check-customer-signed-in.php");

if (customer_signed_in()) {
    ///// Have to check if sesssion customer exist
    unset($_SESSION["user"]["customer"]["cart"]);
    header("location:/public/display-cart.php");
} else {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}