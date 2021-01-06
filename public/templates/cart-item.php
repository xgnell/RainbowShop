<style>
    .cart-item {
        display: grid;
        grid-template-columns: 200px auto;
        gap: 20px;
        /* width: 100%; */
        /* font-size: 27px; */
        /* margin: 15px 15px 15px 15px; */

        margin: 30px 10% 30px 10%;
        padding: 15px 15px 15px 15px;
        background-color: white;
        border-radius: 7px;
        box-shadow: 1px 1px 5px #ccc;
    }

    /* .cart-item .item-picture {
        background-color: red;
    }

    .cart-item .item-info {
        background-color: blue;
    } */

    .cart-item .disp-info-title {
        margin-bottom: 15px;
        font-size: 1em;
        font-weight: bold;
    }

    .cart-item .disp-color {
        display: inline-block;
        width: 20px;
        height: 20px;
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
        <div class="item-picture">
            <img width="200px" src="<?= $item_picture_src . $item["picture"] ?>"><br>
        </div>
        <div class="item-info">
            <!--
            Anh
            Name
            Gia
            Loai
            Mau
            Description
            So luong theo tung Size
            
            Bo ra khoi gio hang

            Thanh toan -> Tao hoa don
            -->
            <h2><?= $item["name"] ?></h2>
            
            <span><?= $item["price"] ?>$</span><br>
            
            <span class="disp-info-title">Loại: </span>
            <span><?= $item_type ?></span><br>
            
            <div style="display: flex;">
                <span class="disp-info-title" style="margin-right: 20px;">Màu: </span>
                <span class="disp-color" style="background-color: <?= $item_color ?>;"></span>
            </div>

            <span class="disp-info-title">Kích thước: </span>
            <span><?= $size ?></span><br>

            <span class="disp-info-title">Số lượng: </span>
            <a href="">-</a>
            <span><?= $amount ?></span>
            <a href="">+</a>
            <br><br>

            <a href="#">Xóa khỏi giỏ hàng</a>


        </div>
    </div>
    <?php
        return $item["price"] * $amount;
    ?>
<?php } ?>