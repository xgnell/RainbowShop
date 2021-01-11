<style>
    .cart-item {
        /* width: 100%; */
        /* font-size: 27px; */
        /* margin: 15px 15px 15px 15px; */

        margin: 30px 10% 30px 10%;
        padding: 5px 15px 15px 15px;
        background-color: white;
        border-radius: 7px;
        box-shadow: 1px 1px 5px #ccc;
    }

    .cart-item .div-title {
        padding: 5px 0 5px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* display: grid;
        grid-template-columns: 200px auto;
        gap: 20px;
        padding: 10px 0 10px 0; */
    }
    .cart-item .div-title .item-name {
        text-align: center;
    }

    .cart-item .div-info {
        display: grid;
        grid-template-columns: 170px auto;
        gap: 20px;
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
        width: 100%;
        height: 100%;
        padding: 10px 10px 10px 10px;
    }
    .cart-item .table-info .table-header {
        height: 30px;
        background-color: #363e7e;
        color: white;
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
        background-color: white;
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
</style>
<?php function spawn_cart_item($item_id, $size, $amount) { ?>
    <?php
        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);

        $item_type = sql_query("
            SELECT type
            FROM item_types
            WHERE id = {$item['id_type']};
        ");
        $item_type = mysqli_fetch_array($item_type)["type"];

        $item_color = sql_query("
            SELECT color
            FROM item_colors
            WHERE id = {$item['id_color']};
        ");
        $item_color = mysqli_fetch_array($item_color)["color"];

        $item_picture_src = "/public/img/items/";
    ?>

    <div class="cart-item">
        <div class="div-title">
            <h2 class="item-name"><?= $item["name"] ?></h2>
            <div class="functions">
                <a class="btn-function"
                    onmouseover="document.getElementById('btn-delete-<?= $item_id . '-' . $size ?>').style.visibility = 'visible'"
                    onmouseout="document.getElementById('btn-delete-<?= $item_id . '-' . $size ?>').style.visibility = 'hidden'">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                    <div class="popup-box" id="btn-delete-<?= $item_id . '-' . $size?>">
                        Xóa sản phẩm khỏi giỏ hàng
                    </div>
                </a>
            </div>
        </div>

        <div class="div-info">
            <div class="item-picture">
                <img width="170px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
            </div>
            <div class="item-details">
                <table class="table-info">
                    <tr>
                        <td style="width: 200px; min-width: 200px;">
                            <span><?= $item["price"] ?> đ</span>
                        </td>

                        <td style="width: 150px; min-width: 150px;">
                            <span><?= $item_type ?></span>
                        </td>

                        <td style="width: 100px; min-width: 100px;">
                            <span class="disp-color" style="background-color: <?= $item_color ?>;"></span>
                        </td>

                        <td style="width: 120px; min-width: 120px;">
                            <span><?= $size ?></span>
                        </td>

                        <td style="width: 250px; min-width: 250px;">
                            <span style="display: inline-block; border-radius: 5px; border: 1px gray solid;">
                                <div style="display: flex; justify-content: space-around;">
                                    <a class="btn-amount" style="border-radius: 5px 0 0 5px;">
                                        -
                                    </a>
                                    <input class="input-amount" type="text" value="<?= $amount ?>">
                                    <a class="btn-amount" style="border-radius: 0 5px 5px 0;">
                                        +
                                    </a>
                                </div>
                            </span>
                        </td>

                    </tr>
                </table>

            </div>
        </div>
    </div>
    <?php
        return $item["price"] * $amount;
    ?>
<?php } ?>
