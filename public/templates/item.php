<style>
    #display-item {
        /* text-align: center;
        font-size: 20px;
        margin: 15px 15px 15px 15px; */
        width: 202px;
        background-color: #e6e6e6;
        padding-top: 1px;
    }
    .display-item .img-item {
        background-color: brown;
        height: 200px;
        padding-top: 1px;
        padding-left: 1px;
        padding-right: 1px;
        /* text-align: center;
        font-size: 20px;
        margin: 15px 15px 15px 15px;
        width: 202px;
        background-color: #e6e6e6;
        padding-top: 1px; */
    }
    .display-item .description {
        background-color:burlywood;
        padding-top: 1px;
        padding-left: 1px;
        padding-right: 1px;
        /* text-align: center;
        font-size: 20px;
        margin: 15px 15px 15px 15px;
        width: 202px;
        background-color: #e6e6e6;
        padding-top: 1px; */
    }
    .display-item .price {
        background-color:cadetblue;
        position: relative; bottom: 1px; left: 1px;
        width: 50%;
        /* text-align: center;
        font-size: 20px;
        margin: 15px 15px 15px 15px;
        width: 202px;
        background-color: #e6e6e6;
        padding-top: 1px; */
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
    <div id="display-item">
        <div class="img-item">
            <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        </div>
        <div class="description">
            hello
            <br>
            Hi<br>
        </div>
        <div class="price">
            <h3><?= $item["price"] ?>$</h3><br>
        </div>
        <!-- <a href="/public/templates/add-item-to-cart.php?id=<?= $item_id ?>">Add item to cart</a> -->
    </div>
<?php } ?>