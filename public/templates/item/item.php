<style>
    .display-item {
        text-align: center;
        font-size: 17px;
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

    .display-item .item-name {
        display: inline-block;
        font-size: 30px;
        font-weight: bold;
        margin: 5px 10px 5px 10px;
    }

    .display-item .item-price {
        display: inline-block;
        font-size: 20px;
        margin: 20px 10px 15px 10px;
    }

    /* .display-item .btn-add-to-cart {
        display: inline-block;
        padding: 10px 10px 10px 10px;
        background-color: red;
        font-weight: bold;
        color: white;
        border-radius: 5px
    }
    .display-item .btn-add-to-cart:hover {
        color: yellow;
    } */
</style>
<?php function spawn_item($item_id) { ?>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/img.php");

        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);
    ?>
    <div class="display-item" onclick="goto_item_details(<?= $item_id ?>)">
        <img width="200px" src="<?= ITEM_IMAGE_SOURCE_PATH . $item["picture"] ?>"><br>
        <span class="item-name" id="name-item"><?= $item["name"] ?></span><br><br>
        <span class="item-price"><?= $item["price"] ?>đ</span><br>
        <!-- <a class="btn-add-to-cart" onclick="add_item_to_cart(<?= $item_id ?>)">Add item to cart</a> -->
    </div>
<?php } ?>