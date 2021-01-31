<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/default.php");
    include_once($root_path . "/public/templates/item/item.php");
    require_once($root_path . "/public/templates/ui/notification/notification-page.php");

    $search = $_GET["search"] ?? "";
    $type_id = $_GET["type_id"] ?? 0;

    // Validate
    // Kiểm tra tính hợp lệ
    if (!is_numeric($type_id)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay về trang chủ",
            "/public/home.php"
        );
        exit();
    }

    $page_now = $_GET['page'] ?? 1;
    // Validate page
    if (!is_numeric($page_now)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay về trang chủ",
            "/public/home.php"
        );
        exit();
    }

    // Mã hóa
    $search = htmlspecialchars($search);

    $background = mysqli_fetch_array(sql_query("
        select *
        from backgrounds
    "));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rainbow fashion</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="stylesheet" href="/public/templates/css/home-style.css">
</head>
<body>
    <!-- <div> -->
        <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
        <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>
        <?php include_once($root_path . "/public/templates/account/sign-in.php"); ?>

        <!-- Display background -->
        <div class="panel">
            <?php include_once($root_path . '/public/templates/ui/backgrounds/background.php')?>
        </div>

        <!-- Display items -->
        <div class="panel">
            <div class="item-menu-area" id="item-menu-area">
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
                        <input id="search-bar" type="text" placeholder="Tìm kiếm sản phẩm">
                        <a id="btn-search" onclick="search_items()" style="cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <?php
                // Lất tất cả sản phẩm
                $query_item_data = "
                SELECT items.id
                FROM items
                INNER JOIN item_types
                    ON items.id_type = item_types.id
                INNER JOIN item_colors
                    ON items.id_color = item_colors.id
                WHERE
                    (name LIKE '%$search%'
                    OR
                    type LIKE '%$search%'
                    OR
                    color LIKE '%$search%')
                ";

                if ($type_id != 0) {
                    $query_item_data .= " AND id_type = $type_id";
                }
                // Đếm sản phẩm để phân trang
                $item_data = sql_query($query_item_data);
                $sum_items = mysqli_num_rows($item_data);
                
                
                $sum_items_a_page = 12;
                $sum_pages = ceil($sum_items / $sum_items_a_page);

                $skip = ($page_now - 1) * $sum_items_a_page; 

                // Giới hạn số sản phẩm trên một trang và đẩy trang
                $query_item_data .= " limit $sum_items_a_page offset $skip";
                $item_data = sql_query($query_item_data); // Kết quả đúng
            ?>

            <div style="display: flex; justify-content: center; margin: 10px 0 20px 0;">
                <?php
                    if ($search != null && $search != "") {
                        ?>
                        <h2 style="color: red;">Tìm thấy <?= $sum_items ?> kết quả với: "<?= $search ?>"</h3>
                        <?php
                    }
                ?>
            </div>

            <div class="item-data-area" id="item-data-area">
                <?php
                    if (mysqli_num_rows($item_data) == 0) {
                        ?>
                        <div class="notification">
                            <h1>Không tìm thấy sản phẩm nào</h1>
                        </div>
                        <?php
                    } else {
                        foreach ($item_data as $item) {
                            spawn_item($item["id"]);
                        }
                    }
                ?>
            </div>
            <br>
            <div style="text-align:center; display: flex; justify-content: center;">
                <?php
                    if ($page_now > 1) {
                        ?>
                        <a class="page-direction" href="?page=<?= $page_now - 1 ?>&search=<?= $search ?>&type_id=<?= $type_id ?>#item-menu-area">
                            <svg style="position: relative; margin-left: 6px;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/></svg>
                        </a>
                        <?php
                    }
                ?>
                
                <?php for ($i = 1; $i <= $sum_pages; $i++) { ?>
                    <a class="page-number <?php if ($i == $page_now) echo "current-page" ?>" href="?page=<?php echo $i ?>&search=<?php echo $search ?>&type_id=<?php echo $type_id ?>#item-menu-area">
                        <?php echo $i ?>
                    </a>
                <?php } ?>
                
                <?php
                    if ($page_now < $sum_pages) {
                        ?>
                        <a class="page-direction" href="?page=<?= $page_now + 1 ?>&search=<?= $search ?>&type_id=<?= $type_id ?>#item-menu-area">
                            <svg style="position: relative; margin-left: 1px;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/></svg>
                        </a>
                        <?php
                    }
                ?>
            </div>
            <script defer>
                var slider_img = document.querySelector('.background');
                var background = [];
                <?php foreach ($backgrounds as $each): ?>
                    background.push('<?php echo $each['picture'] ?>');
                <?php endforeach ?>
                var i = 0;
                function next_background () {
                    if (i >= background.length - 1) i = -1;
                    i++;
                    return setImg();
                }
                function prev_background () {
                    if (i <= 0) i = background.length;
                    i--;
                    return setImg();
                }
                function setImg() {
                    document.getElementById('background').style.backgroundImage = 'url("<?= BACKGROUND_IMAGE_SOURCE_PATH ?>bg4.png")';
                    // return slider_img.setAttribute(<?= BACKGROUND_IMAGE_SOURCE_PATH ?> + background[i]);
                }

                function goto_item_details(item_id) {
                    window.location.href = `/public/display-item-details.php?id=${item_id}`;
                }

                function search_items() {
                    let search_text = document.getElementById('search-bar').value;
                    window.location.href = `?search=${search_text}#item-menu-area`;
                }

                function display_item_by_type() {
                    let item_type_id = parseInt(document.getElementById('input-type').value);
                    window.location.href = `?type_id=${item_type_id}#item-menu-area`;
                }
            </script>
        </div>
        
        <!--///////////////  Here is include footer /////////////-->
        <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
    <!-- </div> -->
</body>
</html>
