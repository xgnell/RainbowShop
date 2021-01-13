<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/item.php");

    // Đoạn này ông ghép cái id zô nè
    $item_id = $_GET['id'];

    $item = sql_query("
            SELECT *
            FROM items
            WHERE id = '$item_id';
        ");
    $item = mysqli_fetch_array($item);

    $item_picture_src = "/public/img/items/";

    // Get item all size types
    $item_sizes = sql_query("
            SELECT *
            FROM item_sizes;
        ");
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
            background-image: url('<?= $item_picture_src . $item['picture'] ?>');
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
            color: white;
            background-color: rgba(54, 62, 126, 60%);
            border-color: #363e7e;
            border-style: solid;
            outline: none;
            cursor: pointer;
        }

        #item-detail .div-buy-item .move-to-cart {
            color: white;
            width: 200px;
            height: 50px;
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
            <form action="/public/templates/add-item-to-cart.php">
                <table style="height: 100%; width: 100%; color: #363e7e;">
                <input type="hidden" name="id" value="<?php echo $item_id; ?>">
                <!-- Tên sản phẩm  -->
                    <tr class="item-name">
                        <td colspan="3">
                            <span style="font-size: 30px;">
                                <?= $item["name"] ?>
                            </span>
                        </td>
                    </tr>
                <!-- Giá sản phẩm  -->
                    <tr class="item-price">
                        <td colspan="3">
                            <b>
                                <span style="font-size: 45px; vertical-align: top;">
                                    <?= $item["price"] ?> $
                                </span>
                            </b>
                        </td>
                    </tr>
                <!-- Phần mô tả  -->
                    <tr>
                        <td style="vertical-align: top;">
                            Mô tả
                        </td>
                        <td style="vertical-align: top;">
                            <?php echo $item['description']; ?>
                        </td>
                    </tr>
                <!-- Cột size -->
                    <tr class="item-size">
                        <td>
                            <span>Size</span>
                        </td>
                        <td colspan="2">
                            <?php foreach ($item_sizes as $each) : ?>
                                <label id="<?php echo $each['size']; ?>">
                                    <input type="radio" name="size" value="<?php echo $each['size']; ?>" id="<?php echo $each['size']; ?>"><?php echo $each['size']; ?>
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
                            <input type="button" value="-">
                            <input type="number" value='1' name="amount" style="width: 50px;">
                            <input type="button" value="+">
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
                            <a href="/public/home.php">
                                <button type="button" class="add-to-cart">Thêm vào giỏ hàng</button>
                            </a>
                            <button type="submit" class="move-to-cart">Mua ngay</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="div-line">
            <div style="width: 90%; border-top: 2px #e0e0e0 solid;">
            </div>
        </div>
        <div id="div-description">
            <div style="width: 90%;">
                <h1>Mô tả sản phẩm</h1>
                <br>
                <?php echo $item['description']; ?>
            </div>
        </div>
    </div>

    <!-- <?php //include_once($root_path . "/public/templates/counselor.php"); 
            ?> -->

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>

</html>