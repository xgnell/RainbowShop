<style>
    /* .order-detail-item {
        margin: 30px 0 30px 0;
        padding: 15px 10px 15px 10px;
        background-color: white;
        border: 1px #ccc solid;
        border-radius: 7px;
        box-shadow: 0px 2px 3px #ccc;
        width: 1000px;
    }

    .order-detail-item .disp-color {
        display: inline-block;
        width: 20px;
        height: 20px;
    }

    .order-detail-item .table-info {
        border: 2px white solid;
        border-collapse: collapse;
        text-align: center;
        vertical-align: middle;
    }

    .order-detail-item .table-info tr {
        border: 2px white solid;
    }
    .order-detail-item .table-info tr {
        border: 2px white solid;
    }
    .order-detail-item .table-info tr td {
        border: 2px white solid;
        background-color: #f7f7f7;
    }
    .order-detail-item .table-info tr th {
        border: 2px white solid;
    }
    .order-detail-item .table-info .btn-amount {
        display: inline-block;
        width: 30px;
        font-size: 22px;
        padding: 3px 4px 3px 4px;
        background-color: #f7f7f7;
        cursor: pointer;
    }
    .order-detail-item .table-info .btn-amount:hover {
        background-color: rgb(208, 209, 214);
    }

    .order-detail-item .table-info .input-amount{
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


    .order-detail-item .btn-function {
        cursor: pointer;
    }
    .order-detail-item .popup-box {
        visibility: hidden;
        position: absolute;
        right: 3em;
        background-color: white;
        border: 1px #ccc solid;
        padding: 10px 10px 10px 10px;
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 20%);
    } */
</style>
<?php function spawn_order_detail_item($item_id, $size_id, $amount, $price) { ?>
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
            <span><?= number_format($price, 0, ',', '.') ?> đ</span>
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
            <span><?= $amount ?></span>
        </td>
    </tr>
<?php } ?>
