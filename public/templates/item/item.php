<style>
    .display-item {
        text-align: center;
        font-size: 15px;
        margin: 20px 25px 40px 25px;
        border-radius: 5px;
        padding: 15px 10px 0px 10px;
        background-color: white;
        border: 1px #ccc solid;
        width: 250px;
        height: 380px;
        cursor: pointer;
        transition: 0.3s;
        /* box-shadow: 0px 5px 5px #858585; */
    }

    .display-item:hover {
        box-shadow: 0px 15px 50px #ccc;
        transition: 0.3s;
        transform: scale(1.1);
    }
    .display-item:hover .item-price {
        background-color: #363e7e;
        color: white;
        transition: 0.3s;
    }

    .display-item .item-name {
        /* background-color: blue; */
        display: inline-block;
        width: 90%;
        height: 70px;
        font-size: 25px;
        font-weight: bold;
        margin: 5px 10px 5px 10px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .display-item .item-price {
        display: inline-block;
        background-color: #dedede;
        width: 90%;
        padding-top: 5px;
        height: 30px;
        font-size: 20px;
        margin: 0px 10px 10px 10px;
    }
</style>
<?php function spawn_item($item_id) { ?>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/default.php");

        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);

        // $string_length = strlen($item["name"]);
        $item_name = $item["name"];
        // if ($string_length < 20) {
        //     $item_name = $item["name"];
        // } else {
        //     $item_name = substr($item["name"], 0, 20) . "...";
        // }
    ?>
    <div class="display-item" onclick="goto_item_details(<?= $item_id ?>)">
        <img width="200px" src="<?= ITEM_IMAGE_SOURCE_PATH . $item["picture"] ?>"><br>
        <span class="item-name" id="name-item"><?= $item_name ?></span><br><br>
        <span class="item-price"><?= number_format($item['price'], 0, ',', '.') ?>đ</span><br>
    </div>
<?php } ?>