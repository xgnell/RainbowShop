<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/account/check-customer-signed-in.php");

if (customer_signed_in()) {
    $item_id = $_GET["id"];
    $item_size_id = $_GET["size_id"];
    $action = $_GET["action"];
    
    ///// Have to check if sesssion customer exist
    // ...

    switch ($action) {
        case 0:
            /* Decrease */

            $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] -= 1;
            // Check for amount = 0
            // if ($_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] < 1) {
            //     header("location:/public/templates/delete-item-from-cart.php?id=$item_id&size_id=$item_size_id");
            //     exit();
            // }
            break;
        case 1:
            /* Increase */
            // $remain_amount = sql_query("
            //     SELECT amount
            //     FROM item_details
            //     WHERE id_item = $item_id AND id_size = $item_size_id;
            // ");
            // $remain_amount = mysqli_fetch_array($remain_amount)["amount"];

            $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] += 1;

            // Check for amount reach limit item: 1 time order | the number of remain items
            // ...
            break;
        case 2:
            /* Change from input */
            break;
        default:
            break;
    }

    header("location:/public/display-cart.php");
} else {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}