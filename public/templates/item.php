<style>
    .display-item {
        text-align: center;
        font-size: 20px;
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
    <div class="display-item">
        <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        <h3><?= $item["price"] ?>$</h3><br>
        <a href="/public/templates/add-item-to-cart.php?id=<?= $item_id ?>">Add item to cart</a>
    </div>
<?php } ?>