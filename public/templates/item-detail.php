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
        }
        #item-img .item-image {
            width: 100%;
            height: 65%;
        }

        #item-detail {
            width: 65%;
            height: 100%;
            padding: 20px;
        }

        #item-detail .item-name {
            width: 100%;
            margin-bottom: 10px;
        }

        #item-detail .item-price {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        #item-detail .div-number {
            width: 100%;
            height: 60px;
            padding: 20px;
            margin-bottom: 10px;
        }

        #item-detail .div-buy-item {
            width: 100%;
            height: 60px;
            padding: 20px;
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
    <div id="page-item">
        <div id="item-img">
            <div class="item-image">
                <center>
                    <img src="<?= $item_picture_src . $item['picture'] ?>" alt="Ảnh sản phẩm">
                </center>
            </div>
        </div>
        <div id="item-detail">
            <div class="item-name">
                <h3>
                    <?= $item["name"] ?>
                </h3>
            </div>
            <div class="item-price">
                <h1>
                    <?= $item["price"] ?>
                </h1>
            </div>

            <div class="div-number">
                - 3 +
            </div>
            <div class="div-buy-item">
                <a href="/public/home.php">
                    <input type="button" value="Thêm vào giỏ hàng" class="add-to-cart">
                </a>

                <a href="/public/home.php">
                    <input type="button" value="Mua ngay" class="move-to-cart">
                </a>
            </div>
        </div>
    </div>

    <?php include_once($root_path . "/public/templates/counselor.php"); ?>

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>

</html>