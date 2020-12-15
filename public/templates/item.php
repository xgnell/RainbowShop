<style>
    .item {
        text-align: center;
        font-size: 27px;
        margin: 15px 15px 15px 15px;
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
    <div class="item">
        <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        <h3><?= $item["price"] ?>$</h3><br>
        <input type="button" value="Add to cart">
    </div>
<?php } ?>