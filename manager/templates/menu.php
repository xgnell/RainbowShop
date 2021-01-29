<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    require_once($root_path . "/manager/templates/notification-page.php");
    if (basename($_SERVER['PHP_SELF']) == "menu.php") {
        display_notification_page(
            false,
            "Quản lý admin",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay về trang trước
        );
        exit();
    }
?>
<link rel="stylesheet" href="/manager/templates/css/menu-style.css">
<script defer src="/manager/templates/js/menu-action.js"></script>
<div id="page-menu">
    <ul class="main-menu">
        
        <?php if (is_admin_rank_valid(1)) { ?>
        <li class="<?php if (MENU_OPTION == "admin") echo "current-option"; ?>">
            <a href="#">Admin</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/admins/admins-manager.php"><li>Xem tất cả admin</li></a>
                <a href="/manager/admins/admin-insert.php"><li>Thêm admin mới</li></a>
            </ul>
        </li>
        <?php } ?>
        
        <a href="/manager/customers/customers-manager.php">
        <li class="<?php if (MENU_OPTION == "customer") echo "current-option"; ?>">
            Khách hàng
        </li>
        </a>
        
        <li class="<?php if (MENU_OPTION == "item") echo "current-option"; ?>">
            <a href="#">Sản phẩm</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/items/items-manager.php"><li>Xem tất cả sản phẩm</li></a>
                <a href="/manager/items/item-insert.php"><li>Thêm sản phẩm mới</li></a>
            </ul>
        </li>
        
        <a href="/manager/orders/orders-manager.php">
        <li class="<?php if (MENU_OPTION == "order") echo "current-option"; ?>">
            Hóa đơn    
        </li>
        </a>
        
        <li class="<?php if (MENU_OPTION == "faq") echo "current-option"; ?>">
            <a href="#">FAQ</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/questions/questions-manager.php"><li>Xem tất cả</li></a>
                <a href="/manager/questions/question-insert.php"><li>Thêm mới</li></a>
            </ul>
        </li>
        <li class="<?php if (MENU_OPTION == "background") echo "current-option"; ?>">
            <a href="#">Custom background</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/backgrounds/background-manager.php"><li>Xem tất cả</li></a>
                <a href="/manager/backgrounds/background-insert.php"><li>Thêm mới</li></a>
            </ul>
<<<<<<< HEAD
        </li>
=======
        </li> -->
        <a href="/manager/contact/view-contact.php">
<<<<<<< HEAD
>>>>>>> c77e7ab95a7e09441835069a863e1b9f614fffb3
=======
>>>>>>> c77e7ab95a7e09441835069a863e1b9f614fffb3
        <li class="<?php if (MENU_OPTION == "contact") echo "current-option"; ?>">
            <ul>
                Contact
            </ul>
        </li>
        </a>
    </ul>
</div>
