<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/item.php");

    $search = $_GET["search"] ?? "";
    $type_id = $_GET["type_id"] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rainbow fashion</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
    <style>
        /* .disp-items > div {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 20px 20px 20px 20px;
            padding: 10px 5px 10px 5px;
            background-color: white;
            border-radius: 7px;
            height: 500px;
            min-width: 800;
        } */

        .panel {
            margin: 30px 5% 30px 5%;
            /* padding: 5px 5px 5px 5px; */
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            min-width: 917px;
        }

        .notification {
            width: 100%;
            padding: 10%;
            text-align: center;
        }
        .notification * {
            margin-bottom: 15px;
        }

        .background {
            background-image: url("/public/img/background/bg1.png");
            background-size: cover;
            border-radius: 5px;
            height: 500px;
            min-width: 917px;
        }

        .item-menu-area {
            display: inline-block;
            width: 95%;
            margin: 5px 25px 50px 25px;
            min-width: 867px;
        }
        .item-menu-area .container {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            border-radius: 5px;
            /* border: 1px #ccc solid;  */
            box-shadow: 0px 10px 50px #ccc;
            /* box-shadow: 0px 1px 3px #ccc; */
        }
        /* .item-menu-area .container:hover {
            box-shadow: 0px 10px 3px #ccc;
        } */
    
        .item-menu-area .container #input-type {
            margin: 5px 15px 5px 15px;
            width: 200px;
            height: 40px;
            border: 1px #ccc solid;
            /* border-radius: 5px; */
            background-color: white;
            padding: 5px 15px 5px 15px;
            /* box-shadow: 0px 10px 150px 5px #ccc; */
            cursor: pointer;
            z-index: 2;
        }
        /* .item-menu-area #type-input:hover {
            background-color: #f7f7f7;
        } */

        .item-menu-area .container #search-bar {
            margin: 5px 10px 5px 15px;
            width: 500px;
            height: 40px;
            /* border-radius: 10px; */
            border: 1px #ccc solid;
            /* box-shadow: 0px 10px 150px 5px #ccc; */
            padding: 5px 10px 5px 15px;
            z-index: 2;
        }
        /* .item-menu-area #search-bar:hover {
            background-color: #f7f7f7;
        } */

        .item-menu-area .container #btn-search {
            text-align: center;
            vertical-align: middle;
            display: inline-block;
            border: 1px #ccc solid;
            background-color: white;
            margin-top: 5px;
            margin-right: 15px;
            width: 50px;
            height: 40px;
        }
        .item-menu-area .container #btn-search:hover {
            background-color: #f7f7f7;
        }
        .item-menu-area .container #btn-search * {
            margin: 7px;
        }

        .item-data-area {
            /* display: flex;
            flex-wrap: wrap; */
            /* justify-content: space-between; */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            justify-content: center;
            align-content: center;
        }

    </style>
</head>

<body>
        <?php include_once($root_path . "/public/templates/header.php"); ?>
        <?php include_once($root_path . "/public/templates/menu.php"); ?>
        <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

        <!-- Display background -->
        <div class="panel">
            <div class="background">
            </div>
        </div>

        <!-- Display items -->
        <div class="panel">
            <div class="item-menu-area">
                <div class="container">
                    <?php
                        // Get all item types
                        $item_types = sql_query("
                            SELECT *
                            FROM item_types;
                        ");
                    ?>
                    <select name="" id="input-type" onchange="display_item_by_type()">
                        <option value="" disabled selected hidden>Chọn loại sản phẩm</option>
                        <?php
                            foreach ($item_types as $item_type) {
                                ?>
                                <option value="<?= $item_type["id"] ?>"
                                    <?php if ($item_type["id"] == $type_id) echo "selected"; ?>><?= $item_type["type"] ?>
                                </option>
                                <?php
                            }
                        ?>
                    </select>
                    <div style="display: flex;">
                        <input id="search-bar" type="text" placeholder="Tìm kiếm tên sản phẩm">
                        <!-- <button id="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        </button> -->
                        <a id="btn-search" onclick="search_items()" style="cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="item-data-area">
                <?php
                // \\\\\\\\\\\\\\\\\\    Show all items
                    $query_item_data = "
                        SELECT id
                        FROM items
                        WHERE name LIKE '%$search%'
                    ";

                    if ($type_id == 0) {
                        $query_item_data .= ";";
                    } else {
                        $query_item_data .= " AND id_type = $type_id";
                    }
                    // .................Count all item..................
                    $item_data = sql_query($query_item_data);
                    $sum_items = mysqli_num_rows($item_data);
                    $sum_items_a_page = 4;
                    $sum_pages = ceil($sum_items / $sum_items_a_page);

                    $page_now = 1;
                    if(isset($_GET['page'])){
                        $page_now = $_GET['page'];
                    }

                    $skip = ($page_now - 1) * $sum_items_a_page; 

                    // \\\\\\\\\\\\\\\\\\\\      show item have limit
                    $query_item_data = "
                        SELECT id
                        FROM items
                        WHERE name LIKE '%$search%'
                        limit $sum_items_a_page offset $skip
                    ";
                    $item_data = sql_query($query_item_data); // Kết quả đúng


                    if (mysqli_num_rows($item_data) == 0) {
                        ?>
                        <div class="notification">
                            <h1>Không tìm thấy sản phẩm tương ứng</h1>
                        </div>
                        <?php
                    } else {
                        foreach ($item_data as $item) {
                            spawn_item($item["id"]);
                        }
                    }
                ?>
            </div>
            <h1>Tổng số sản phẩm: <?php echo $sum_items ?></h1>
            <br>
            <div style="text-align:center;">
                <?php for ($i = 1; $i <= $sum_pages; $i++) { ?>
                    <a href="?page=<?php echo $i ?>&search=<?php echo $search ?>">
                        <?php echo $i ?>
                    </a>
                <?php } ?>
            </div>
            <script defer>
                function goto_item_details(item_id) {
                    window.location.href = `/public/display-item-details.php?id=${item_id}`;
                }

                function search_items() {
                    let search_text = document.getElementById('search-bar').value;
                    window.location.href = `/public/home.php?search=${search_text}`;
                }

                function display_item_by_type() {
                    let item_type_id = parseInt(document.getElementById('input-type').value);
                    window.location.href = `/public/home.php?type_id=${item_type_id}`;
                }
            </script>
        </div>
        
        <!--///////////////  Here is include footer /////////////-->
        <div>
            <?php include_once($root_path . "/public/templates/footer.php"); ?>
        </div>
    </div>
</body>
</html>
