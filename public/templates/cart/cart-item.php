<!-- <style>
    .cart-item {
        margin: 30px 0 30px 0;
        padding: 15px 10px 15px 10px;
        background-color: white;
        border: 1px #ccc solid;
        border-radius: 7px;
        box-shadow: 0px 2px 3px #ccc;
        width: 1075px;
    }

    .cart-item .disp-color {
        display: inline-block;
        width: 20px;
        height: 20px;
    }

    .cart-item .table-info {
        border: 2px white solid;
        border-collapse: collapse;
        text-align: center;
        vertical-align: middle;
    }
    .cart-item .table-info tr {
        border: 2px white solid;
    }
    .cart-item .table-info tr {
        border: 2px white solid;
    }
    .cart-item .table-info tr td {
        border: 2px white solid;
        background-color: #f7f7f7;
    }
    .cart-item .table-info tr th {
        border: 2px white solid;
    }
    .cart-item .table-info .btn-amount {
        display: inline-block;
        width: 30px;
        font-size: 22px;
        padding: 3px 4px 3px 4px;
        background-color: #f7f7f7;
        cursor: pointer;
    }
    .cart-item .table-info .btn-amount:hover {
        background-color: rgb(208, 209, 214);
    }

    .cart-item .table-info .input-amount{
        width: 70px;
        margin: 0;
        text-align: center;
        padding: 5px 5px 5px 5px;
        border-radius: 0px;
        border: 0px;
        border-left: 1px gray solid;
        border-right: 1px gray solid;
        background-color: #f7f7f7;
        color: black;
    }


    .cart-item .btn-function {
        cursor: pointer;
    }
    .cart-item .popup-box {
        visibility: hidden;
        position: absolute;
        right: 3em;
        background-color: white;
        border: 1px #ccc solid;
        padding: 10px 10px 10px 10px;
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 20%);
    }
</style> -->
<?php function spawn_cart_item($item_id, $size_id, $amount) { ?>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/default.php");

        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);

        $size_name = sql_query("
            SELECT size
            FROM item_sizes
            WHERE id = $size_id;
        ");
        $size_name = mysqli_fetch_array($size_name)["size"];

        $item_type = sql_query("
            SELECT type
            FROM item_types
            WHERE id = {$item['id_type']};
        ");
        $item_type = mysqli_fetch_array($item_type)["type"];

        $item_color = sql_query("
            SELECT code
            FROM item_colors
            WHERE id = {$item['id_color']};
        ");
        $item_color = mysqli_fetch_array($item_color)["code"];
    ?>

    <tr>
        <td>
            <img width="100px" src="<?= ITEM_IMAGE_SOURCE_PATH . $item["picture"] ?>"><br>
        </td>

        <td>
            <span><?= $item["name"] ?></span>
        </td>

        <td>
            <span><?= number_format($item['price'], 0, ',', '.') ?> đ</span>
        </td>

        <td>
            <span><?= $item_type ?></span>
        </td>

        <td>
            <span class="disp-color" style="background-color: <?= $item_color ?>; <?php if ($item_color == 'white') echo 'border: 1px black solid;' ?>"></span>
        </td>

        <td>
            <span><?= $size_name ?></span>
        </td>

        <td>
            <span style="display: inline-block; border-radius: 5px; border: 1px gray solid;">
                <div style="display: flex; justify-content: space-around;">
                    <?php
                        if ($_SESSION["user"]["customer"]["cart"][$item_id][$size_id] > 1) {
                            ?>
                            <a href="/public/templates/item/change-item-amount.php?action=0&id=<?= $item_id ?>&size_id=<?= $size_id ?>" class="btn-amount" style="color: black; border-radius: 5px 0 0 5px;">
                                -
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="btn-amount" style="color: gray; border-radius: 5px 0 0 5px;">
                                -
                            </a>
                            <?php
                        }
                    ?>
                    
                    <input class="input-amount" type="text" value="<?= $amount ?>" disabled>
                    
        
                    <?php
                        $remain_amount = sql_query("
                            SELECT amount
                            FROM item_details
                            WHERE id_item = $item_id AND id_size = $size_id;
                        ");
                        $remain_amount = mysqli_fetch_array($remain_amount)["amount"] ?? 0;

                        // Xu ly van de hang con chua ton tai trong kho
                        // ... (Nhung ma neu lam chuan muc thi ko can cai check nay)

                        if ($_SESSION["user"]["customer"]["cart"][$item_id][$size_id] < $remain_amount) {
                            ?>
                            <a href="/public/templates/item/change-item-amount.php?action=1&id=<?= $item_id ?>&size_id=<?= $size_id ?>" class="btn-amount" style="color: black; border-radius: 0 5px 5px 0;">
                                +
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="btn-amount" style="color: gray; border-radius: 0 5px 5px 0;">
                                +
                            </a>
                            <?php
                        }
                    ?>
                </div>
            </span>
        </td>

        <td>
            <a class="btn-function" href="/public/templates/item/delete-item-from-cart.php?id=<?= $item_id ?>&size_id=<?= $size_id ?>"
                onmouseover="document.getElementById('btn-delete-<?= $item_id . '-' . $size_id ?>').style.visibility = 'visible'"
                onmouseout="document.getElementById('btn-delete-<?= $item_id . '-' . $size_id ?>').style.visibility = 'hidden'">
                
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                <div style="color: black;" class="popup-box" id="btn-delete-<?= $item_id . '-' . $size_id?>">
                    Xóa sản phẩm khỏi giỏ hàng
                </div>
            </a>
        </td>

    </tr>
    <?php
        return $item["price"] * $amount;
    ?>
<?php } ?>
