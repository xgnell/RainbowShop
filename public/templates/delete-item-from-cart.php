<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/check-customer-signed-in.php");

if (customer_signed_in()) {
    $item_id = $_GET["id"];
    $item_size_id = $_GET["size_id"];
    ///// Have to check if sesssion customer exist
    unset($_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id]);
    header("location:/public/display-cart.php");
} else {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}