<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/img.php");
    include_once($root_path . "/public/templates/item/item.php");

    $item_id = $_GET['id'];

    $item = sql_query("
        SELECT *
        FROM items
        WHERE id = '$item_id';
    ");
    $item = mysqli_fetch_array($item);

    $item_type = sql_query("
        SELECT type
        FROM item_types
        WHERE id = {$item["id_type"]};
    ");
    $item_type = mysqli_fetch_array($item_type)["type"];

    // Get item all size types possible
    $item_sizes = sql_query("
        SELECT id_size
        FROM item_details
        WHERE id_item = $item_id;
    ");

    // Get color item
    $item_color = sql_query("
        select code
        from item_colors
        join items
        on item_colors.id = items.id_color
        where items.id = '$item_id'
    ");
    $item_color = mysqli_fetch_array($item_color)['code'];

    $image_patch = "/public/assets/items/"
    // Check for amount of size in database
    // ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm: <?php echo $item['name']; ?></title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <style>
        #page-item {
            margin-top: 40px;
            margin-bottom: 40px;
            margin-left: 10%;
            margin-right: 10%;
            background-color: white;
            width: 80%;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            display: flex;
            flex-wrap: wrap;
            flex-grow: 2;
            padding: 20px;
            /* height: 500px; */
        }
        #page-item * {
            font-size: 20px;
        }

        #item-img {
            width: 40%;
            height: 100%;
            padding: 20px;
            margin: auto;
            /* background-color: #ffdec9; */
        }

        #item-img .item-image {
            background-color: #ff8030;
            margin: auto;
            /* width: 80%;
            height: 65%; */
            background-image: url('<?= ITEM_IMAGE_SOURCE_PATH . $item['picture'] ?>');
            width: 400px;
            height: 400px;
            background-size: cover;
        }

        #item-detail {
            width: 60%;
            height: 470px;
            padding: 10px 20px 20px 20px;
            /* background-color: #ccc; */
        }

        #item-detail .item-name {
            line-height: 29px;
            width: 100%;
            /* background-color: #ffdec9; */
            margin-bottom: 10px;
        }

        #item-detail .item-price {
            line-height: 57px;
            width: 100%;
            height: 160px;
            /* background-color: #ffdec9; */
            margin-bottom: 10px;
        }

        #item-detail .item-size {
            width: 100%;
            /* background-color: #ffdec9; */
            margin-bottom: 10px;
        }

        #item-detail .item-number {
            /* background-color: #ffdec9; */
            width: 100%;
            /* height: 60px; */
            /* padding-top: 20px; */
            margin-bottom: 10px;
        }

        #item-detail .div-buy-item {
            /* background-color: #ffdec9; */
            width: 100%;
            /* height: 60px; */
            padding-bottom: 0px;
            margin-bottom: 0px;
        }

        #item-detail .div-buy-item .add-to-cart {
            width: 200px;
            height: 50px;
            font-size: 17px;
            color: white;
            background-color: rgba(54, 62, 126, 70%);
            /* background-color: red; */
            /* border-radius: 5px; */
            border: 0px;
            border-color: #363e7e;
            border-style: solid;
            outline: none;
            cursor: pointer;
        }
        
        /* #item-detail .div-buy-item .add-to-cart:hover {
            color: yellow;
        } */

        #item-detail .div-buy-item .move-to-cart {
            color: white;
            width: 200px;
            height: 50px;
            font-size: 17px;
            background-color: #363e7e;
            border-style: none;
            outline: none;
            cursor: pointer;
        }

        #div-line {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 70px;
        }

        #div-description {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #item-detail .btn-amount {
            display: inline-block;
            text-align: center;
            width: 30px;
            font-size: 22px;
            padding: 3px 4px 3px 4px;
            background-color: #f7f7f7;
            cursor: pointer;
        }
        #item-detail .btn-amount:hover {
            background-color: rgb(208, 209, 214);
        }

        #item-detail .input-amount{
            width: 70px;
            margin: 0;
            text-align: center;
            padding: 5px 5px 5px 5px;
            border-radius: 0px;
            border: 0px;
            border-left: 1px gray solid;
            border-right: 1px gray solid;
            background-color: #f7f7f7;
            color: black;
        }

        .same-item {
            margin-top: 40px;
            margin-bottom: 40px;
            margin-left: 10%;
            margin-right: 10%;
            background-color: white;
            width: 80%;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        }
        .same-item .show-same-item {
            background-color: white;
            border-radius: 7px;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .same-item .show-same-item .small-item {
            float: left;
            margin-left: 20px;
            margin-right: 20px;
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>

    <div id="page-item">
        <div id="item-img">
            <!-- ========== Ảnh sản phẩm ở đây ============= -->
            <div class="item-image">
            </div>
        </div>

        <!-- ============= Thông tin về sản phẩm ================= -->
        <div id="item-detail">
            <input type="text" value="<?php echo $item["id"] ?>" hidden>
            <!-- ============= Form để chuyển các thông tin sang giỏ hàng =========== -->
            <form action="/public/templates/cart/add-item-to-cart.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $item_id; ?>">
                <table style="height: 100%; width: 100%;">
                <!-- Tên sản phẩm  -->
                    <tr class="item-name">
                        <td colspan="3">
                            <span style="font-size: 45px;">
                                <?= $item["name"] ?>
                            </span>
                        </td>
                    </tr>
                <!-- Giá sản phẩm  -->
                    <tr class="item-price">
                        <td colspan="3">
                            <b>
                                <span style="font-size: 30px; vertical-align: top;">
                                    <?= $item["price"] ?> đ
                                </span>
                            </b>
                        </td>
                    </tr>
                <!-- Màu sắc -->
                    <tr>
                        <td>
                            <span>Màu sắc</span>
                        </td>
                        <td>
                            <div style="
                                display: inline-block;
                                width: 20px; height: 20px;
                                background-color: <?= $item_color ?>;
                                <?php
                                    if ($item_color == 'white')
                                        echo 'border: 1px black solid;';
                                ?>">
                            </div>
                        </td>
                    </tr>
                <!-- Loại sản phẩm -->
                    <tr class="item-type">
                        <td>
                            <span">Loại</span>
                        </td>
                        <td>
                            <span><?= $item_type ?></span>
                        </td>
                        <!-- <td>
                            <span>
                                Còn lại
                                <input type="text" value="12" disabled>
                                sản phẩm
                            </span>
                        </td> -->
                    </tr>
                    <tr class="item-size">
                        <td>
                            <span>Size</span>
                        </td>
                        <td colspan="2">
                            <?php foreach ($item_sizes as $item_size) : ?>
                                <?php
                                    $size_name = sql_query("
                                        SELECT size
                                        FROM item_sizes
                                        WHERE id = {$item_size["id_size"]};
                                    ");
                                    $size_name = mysqli_fetch_array($size_name)["size"];  
                                ?>
                                <label id="<?php echo $item_size['size']; ?>">
                                    <input type="radio" name="size_id" value="<?php echo $item_size['id_size']; ?>" id="<?php echo $size_names; ?>" checked>
                                    <?php echo " ", $size_name; ?>
                                </label>
                            <?php endforeach ?>
                        </td>
                    </tr>
                <!-- Cột số lượng -->
                    <tr class="item-number">
                        <td>
                            <span>Số lượng</span>
                        </td>
                        <td>
                            <span style="display: inline-block; border-radius: 5px; border: 1px gray solid;">
                                <div style="display: flex; justify-content: space-around;">
                                    <a onclick="change_amount(0)" class="btn-amount" style="border-radius: 5px 0 0 5px;">
                                        -
                                    </a>
                                    <input id="input-amount" class="input-amount" type="text" name="amount" value="1" readonly>
                                    <a onclick="change_amount(1)" class="btn-amount" style="border-radius: 0 5px 5px 0;">
                                        +
                                    </a>
                                </div>
                            </span>
                        </td>
                        <!-- <td>
                            <span>
                                Còn lại
                                <input type="text" value="12" disabled>
                                sản phẩm
                            </span>
                        </td> -->
                    </tr>
                <!-- Cột thêm vào giỏ hàng -->
                    <tr class="div-buy-item">
                        <td colspan="3">
                            <!-- <a href="/public/templates/add-item-to-cart.php"> -->
                                <button type="submit" class="add-to-cart" onclick="return add_item_to_cart(0)">Thêm vào giỏ hàng</button>
                            <!-- </a> -->
                            <button type="submit" class="move-to-cart" onclick="return add_item_to_cart(1)">Mua ngay</button>
                        </td>
                    </tr>
                </table>
                <input id="input-redirect" type="text" name="redirect" value="" hidden>
            </form>
        </div>
        <div id="div-line">
            <div style="width: 90%; border-top: 2px #e0e0e0 solid;">
            </div>
        </div>
        <div id="div-description">
            <div style="width: 90%;">
                <span style="font-size: 30px; font-weight: bold;">Mô tả sản phẩm</span>
                <br><br>
                <span style="font-size: 18px;"><?php echo $item['description']; ?></span>
            </div>
        </div>
    </div>
    <div class="same-item">
        <div style="padding-left: 80px; padding-top:20px; font-size: 30px; font-weight: bold;" >Sản phẩm tương tự</div>
        <div class="show-same-item">
            <div style="display: flex; justify-content:center;">
                <?php
                $sql = "
                    select *
                    from items
                    where id_type = ('$item[id_type]') and id != '$item[id]'
                    limit 7
                ";
                    $same_item = sql_query($sql);
                ?>
                <?php foreach ($same_item as $each) { ?>
                    <input type="text" name="id" value="<?php echo $each['id']; ?>" hidden>
                    <a href="/public/display-item-details.php?id=<?php echo $each['id']; ?>">
                        <div style="margin-left: 10px; margin-right:10px">
                            <span style="width: 150px;">
                                <img src="<?php echo $image_patch . $each["picture"] ?>" alt="<?php echo $each["picture"] ?>" style="width: 150px;">
                            </span>
                            <br>
                            <span><?php echo $each["name"] ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <script defer>
        let amount = 1;
        let input_amount = document.getElementById('input-amount');
        function change_amount(action) {
            switch (action) {
                case 0:
                    // Decrease
                    amount--;
                    break;
                case 1:
                    // Increase
                    amount++;
                    break;
                default:
                    break;
            }
            input_amount.value = amount;
        }

        function add_item_to_cart(redirect) {
            <?php
            if (customer_signed_in()) {
                ?>
                document.getElementById("input-redirect").value = redirect;
                return true;
                // window.location.href = `/public/templates/item-detail.php?id=${item_id}`;
                <?php
            } else {
                ?>
                document.getElementById('sign-in-form').style.visibility = 'visible';
                return false;
                <?php
            }
            ?>
        }
    </script>

    <!-- <?php //include_once($root_path . "/public/templates/counselor.php"); 
            ?> -->

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>
</html>