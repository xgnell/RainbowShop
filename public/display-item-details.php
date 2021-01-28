<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/default.php");
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
        SELECT id_size, amount
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
    <link rel="stylesheet" href="/public/templates/css/display-item-details-style.css">
    <style>
        #item-img .item-image {
            background-color: #ff8030;
            margin: auto;
            /* width: 80%;
            height: 65%; */
            background-image: url('<?= ITEM_IMAGE_SOURCE_PATH . $item['picture'] ?>');
            width: 380px;
            height: 380px;
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>

    <div id="page-item">
        <div id="item-img" style="width: 50%;">
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
                <table style="height: 100%; width: 100%">
                    <!-- Tên sản phẩm  -->
                    <tr class="item-name">
                        <td colspan="3">
                            <span style="font-size: 40px;">
                                <?= $item["name"] ?>
                            </span>
                        </td>
                    </tr>


                    <!-- Giá sản phẩm  -->
                    <tr class="item-price">
                        <td colspan="3">
                            <b>
                                <span style="font-size: 30px; vertical-align: top;">
                                    <?= number_format($item['price'], 0, ',', '.') ?> VNĐ
                                </span>
                            </b>
                        </td>
                    </tr>


                    <!-- Màu sắc -->
                    <tr>
                        <td class="display-title">
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
                        <td class="display-title">
                            <span">Loại</span>
                        </td>
                        <td>
                            <span><?= $item_type ?></span>
                        </td>
                    </tr>

                    <!-- Size -->
                    <tr class="item-size">
                        <td class="display-title">
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
                                <div>
                                <label id="<?php echo $item_size['size']; ?>">
                                    <input class="choose-size"
                                        type="radio"
                                        name="size_id"
                                        value="<?php echo $item_size['id_size']; ?>"
                                        id="<?php echo $size_names; ?>" checked
                                        onchange="change_size()">
                                    <span class="choose-label"><?php echo " ", $size_name; ?></span>
                                </label>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>


                    <!-- Cột số lượng -->
                    <tr class="item-number">
                        <td class="display-title">
                            <span>Số lượng</span>
                        </td>
                        <td>
                            <script>
                                let size_data = <?php
                                    $size_data = [];
                                    foreach ($item_sizes as $size) {
                                        $size_data[$size['id_size']] = intval($size['amount']);
                                    }
                                    echo json_encode($size_data);
                                ?>;
                                // console.log(size_data);
                            </script>
                            <span style="display: inline-block; border-radius: 5px; border: 1px gray solid;">
                                <div style="display: flex; justify-content: space-around;">
                                    <a onclick="change_amount(0)" id="decrease-amount" class="btn-amount" style="border-radius: 5px 0 0 5px;">
                                        <svg style="position: relative; top: 3px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg>
                                    </a>
                                    <input id="input-amount" class="input-amount" type="text" name="amount" value="1" readonly>
                                    <a onclick="change_amount(1)" id="increase-amount" class="btn-amount" style="border-radius: 0 5px 5px 0;">
                                        <svg style="position: relative; top: 3px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                                    </a>
                                </div>
                            </span>
                        </td>
                        
                    </tr>


                    <!-- Cột thêm vào giỏ hàng -->
                    <tr class="div-buy-item">
                        <td colspan="3">
                            <button type="submit" class="add-to-cart" onclick="return add_item_to_cart(0)">Thêm vào giỏ hàng</button>
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


    <?php
        $sql = "
            select *
            from items
            where id_type = ('$item[id_type]') and id != '$item[id]'
            limit 4;
        ";
        $same_item = sql_query($sql);
    ?>
    <?php if (mysqli_num_rows($same_item) > 0): ?>
    <div class="same-item">
        <div style="padding-left: 70px; padding-top:20px; font-size: 30px; font-weight: bold;" >
            Sản phẩm tương tự
        </div>
        <div class="show-same-item">
            <div style="display: flex; text-align: center; padding-left: 50px;">
                
                <?php foreach ($same_item as $each) { ?>
                    <input type="text" name="id" value="<?php echo $each['id']; ?>" hidden>
                    <a href="/public/display-item-details.php?id=<?php echo $each['id']; ?>">
                        <div class="show-item">
                            <span style="width: 150px; padding: 10px 10px 0px 10px;">
                                <img src="<?php echo $image_patch . $each["picture"] ?>" alt="<?php echo $each["picture"] ?>" style="width: 150px;">
                            </span>
                            <br>
                            <span style="display: inline-block; width: 90%; height: 50px; overflow: hidden; text-overflow: ellipsis; color: black;"><?php echo $each["name"] ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php endif ?>

    <script defer>
        let amount = 1;
        let input_amount = document.getElementById('input-amount');
        function change_amount(action) {
            switch (action) {
                case 0:
                    // Decrease
                    if (amount > 1) {
                        amount--;
                    } else {
                        document.getElementById('decrease-amount').disable = true;
                    }
                    break;
                case 1:
                    // Increase
                    // Get current size
                    let max_amount = 1;
                    let sizes = document.getElementsByName('size_id');
                    for (const size of sizes) {
                        if (size.checked) {
                            max_amount = size_data[parseInt(size.value)];
                            if (amount < max_amount) {
                                amount++;
                            } else {
                                document.getElementById('increase-amount').disable = true;
                            }
                            break;
                        }
                    }
                    break;
                default:
                    break;
            }
            input_amount.value = amount;
        }

        function change_size() {
            amount = 1;
            input_amount.value = amount;
        }

        function add_item_to_cart(redirect) {
            <?php
            if (customer_signed_in()) {
                ?>
                document.getElementById("input-redirect").value = redirect;
                return true;
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

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>
</html>