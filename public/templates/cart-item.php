<style>
    .cart-item {
        width: 100%;
        font-size: 27px;
        margin: 15px 15px 15px 15px;
    }
</style>
<?php function spawn_cart_item($item_id, $amount) { ?>
    <?php
        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
        $item = mysqli_fetch_array($item);

        $item_picture_src = "/public/img/items/";
    ?>
    <div class="cart-item">
        <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        <h3><?= $item["price"] ?>$</h3><br>
        <a href="/public/templates/add-item-to-cart.php?id=<?= $item_id ?>">Add item to cart</a>
    </div>
<?php } ?>