<style>
    .item {
        text-align: center;
        font-size: 27px;
        margin: 15px 15px 15px 15px;
    }
</style>
<?php function spawn_item($src, $price) { ?>
    <div class="item">
        <img src="<?php echo $src; ?>" alt="Ảnh sản phẩm"><br>
        <h5><?php echo $price; ?></h5>
    </div>
<?php } ?>