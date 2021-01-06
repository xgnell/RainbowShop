<style>
    .display-item {
        text-align: center;
        font-size: 17px;
        margin: 30px 25px 30px 25px;
        /*border: 1px black solid;*/
        border-radius: 5px;
        padding: 15px 10px 15px 10px;
        border: 1px #ccc solid;
        width: 250px;
        /*height: 420px;*/
        cursor: pointer;
        transition: 0.3s;
        /*box-shadow: 0px 5px 5px #858585;*/
    }

    .display-item:hover {
        box-shadow: 0px 10px 50px 10px #ccc;
        transition: 0.3s;
        transform: scale(1.1);
    }

    .display-item .item-name {
        display: inline-block;
        font-size: 30px;
        font-weight: bold;
        margin: 20px 10px 15px 10px;
    }

    .display-item .item-price {
        display: inline-block;
        margin: 10px 10px 25px 10px;
    }

    .display-item .btn-add-to-cart {
        display: inline-block;
        padding: 10px 10px 10px 10px;
        background-color: red;
        font-weight: bold;
        color: white;
        border-radius: 5px
    }
    .display-item .btn-add-to-cart:hover {
        color: yellow;
    }
</style>
<?php function spawn_item($item_id) { ?>
    <?php
        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);

        $item_picture_src = "/public/img/items/";
    ?>
    <div class="display-item">
        <span class="item-name"><?= $item["name"] ?></span><br><br>
        <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        <span class="item-price"><?= $item["price"] ?>$</span><br>
        <a class="btn-add-to-cart" onclick="add_item_to_cart(<?= $item_id ?>)">Add item to cart</a>
    </div>
<?php } ?>