<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "home");
require_once($root_path . "/public/templates/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");
include_once($root_path . "/public/templates/item.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
    <style>
        #page-item {
            margin-top: 80px;
            background-color: white;
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            display: flex;
        }

        #item-img {
            width: 35%;
            padding: 20px;
            margin: auto;
            background-color: #ffdec9;
        }

        #item-img .item-image {
            width: 100%;
            height: 65%;
        }

        #item-detail {
            width: 65%;
            height: 100%;
            padding-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 0px;
            background-color: #ccc;
        }

        #item-detail .item-name {
            line-height: 29px;
            width: 100%;
            background-color: #ffdec9;
            margin-bottom: 10px;
        }

        #item-detail .item-price {
            line-height: 57px;
            width: 100%;
            /* height: 100px; */
            background-color: #ffdec9;
            margin-bottom: 10px;
        }

        #item-detail .item-size {
            width: 100%;
            background-color: #ffdec9;
            margin-bottom: 10px;
        }

        #item-detail .item-number {
            background-color: #ffdec9;
            width: 100%;
            /* height: 60px; */
            /* padding-top: 20px; */
            margin-bottom: 10px;
        }

        #item-detail .div-buy-item {
            background-color: #ffdec9;
            width: 100%;
            /* height: 60px; */
            /* padding-top: 20px; */
            margin-bottom: 10px;
        }

        #item-detail .div-buy-item .add-to-cart {
            width: 170px;
            height: 40px;
            background-color: #ffdec9;
            border-color: #ff8030;
            border-style: solid;
            outline: none;
        }

        #item-detail .div-buy-item .move-to-cart {
            color: white;
            width: 170px;
            height: 40px;
            background-color: #ff8030;
            border-style: none;
            outline: none;
        }


        /* .disp-items>div {
            display: flex;
            justify-content: space-between;
            margin: 20px 20px 20px 20px;
            padding: 10px 5px 10px 5px;
            background-color: white;
            border-radius: 7px;
            height: 450px;
            min-width: 800;
        }

        .panel {
            margin: 30px 10% 30px 10%;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        } */
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/header.php"); ?>

    <?php include_once($root_path . "/public/templates/menu.php"); ?>

    <?php
    $item_id = 24;
    $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
    $item = mysqli_fetch_array($item);

    $item_picture_src = "/public/img/items/";
    ?>
    <?php
        // Get item all size types
        $item_sizes = sql_query("
            SELECT *
            FROM item_sizes;
        ");
    ?>
    <div id="page-item">
        <div id="item-img">
            <!-- ========== Ảnh sản phẩm ở đây ============= -->
            <div class="item-image">
                <center>
                    <img src="<?= $item_picture_src . $item['picture'] ?>" alt="Ảnh sản phẩm">
                </center>
            </div>
        </div>

        <!-- ============= Thông tin về sản phẩm ================= -->
        <div id="item-detail">
            <input type="text" value="<?php echo $item["id"] ?>" hidden>
        <!-- ============= Form để chuyển các thông tin sang giỏ hàng =========== -->
            <form action="/public/cart.php">
                <table>
                    <tr class="item-name">
                        <td colspan="3">
                            <h3>
                                <?= $item["name"] ?>
                            </h3>
                        </td>
                    </tr>
                    <tr class="item-price">
                        <td colspan="3">
                            <h1>
                                <?= $item["price"] ?>
                            </h1>
                        </td>
                    </tr>
                    <tr class="item-size">
                        <td>
                            <span>Size</span>
                        </td>
                        <td colspan="2">
                            <?php foreach ($item_sizes as $each): ?>
                                <label id="<?php echo $each['size']; ?>">
                                    <input type="radio" name="size" id="<?php echo $each['size']; ?>"><?php echo $each['size']; ?>
                                </label>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr class="item-number">
                        <td>
                            <span>Số lượng</span>
                        </td>
                        <td>
                            <input type="button" value="-">
                            <input type="number" value='1' name="number" style="width: 50px;">
                            <input type="button" value="+">
                        </td>
                        <td>
                            <span>
                                Còn lại
                                    <input type="text" value="12" disabled>
                                sản phẩm
                            </span>
                        </td>
                    </tr>
                    <tr class="div-buy-item">
                        <td colspan="3">
                            <a href="/public/home.php">
                                <button type="button" class="add-to-cart">Thêm vào giỏ hàng</button>
                            </a>
                            <button type="submit" class="move-to-cart">Mua ngay</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include_once($root_path . "/public/templates/counselor.php"); ?>

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>

</html>