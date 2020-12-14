<style>
    .item {
        text-align: center;
        font-size: 27px;
        margin: 15px 15px 15px 15px;
    }
</style>
<?php function spawn_item($src, $price)
{ ?>
    <div class="item">
        <!-- ảnh trên và mô tả -->
        <div>
            <img src="<?php echo $src; ?>" alt="Ảnh sản phẩm"><br>
            <span class="description" name="description"></span>
        </div>

        <!-- Giá và thêm vào giỏ hàng -->
        <div class='item_cart'>
            <div style="width: 70%; background-color:aquamarine;">
                <h5>Price: <?php echo $price; ?></h5>
            </div>

            <a href="">
                <div style="width: 70%; background-color:blueviolet;">
                    Thêm vào giỏ hàng
                </div>
            </a>
        </div>
    </div>
<?php } ?>