<link rel="stylesheet" href="/manager/templates/css/menu-style.css">
<script defer src="/manager/templates/js/menu-action.js"></script>
<div id="page-menu">
    <ul class="main-menu">
        
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/check-admin-signed-in.php"); ?>
        <?php if (is_admin_rank(1)) { ?>
        <li class="<?php if (MENU_OPTION == "admin") echo "current-option"; ?>">
            <a href="#">Admin</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/admins/admins-manager.php"><li>Xem tất cả admin</li></a>
                <a href="/manager/admins/admin-insert.php"><li>Thêm admin mới</li></a>
            </ul>
        </li>
        <?php } ?>
        
        <li class="<?php if (MENU_OPTION == "customer") echo "current-option"; ?>">
            <a href="#">Khách hàng</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/customers/customers-manager.php"><li>Xem tất cả khách hàng</li></a>
                <a href="/manager/customers/customer-insert.php"><li>Thêm khách hàng mới</li></a>
            </ul>
        </li>
        
        <li class="<?php if (MENU_OPTION == "item") echo "current-option"; ?>">
            <a href="#">Sản phẩm</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/items/items-manager.php"><li>Xem tất cả sản phẩm</li></a>
                <a href="/manager/items/item-insert.php"><li>Thêm sản phẩm mới</li></a>
            </ul>
        </li>
        
        <li class="<?php if (MENU_OPTION == "order") echo "current-option"; ?>">
            <a href="#">Hóa đơn</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/orders/orders-manager.php"><li>Xem tất cả hóa đơn</li></a>
            </ul>
        </li>
        
        <li class="<?php if (MENU_OPTION == "faq") echo "current-option"; ?>">
            <a href="#">FAQ</a>
            <ul class="sub-menu" hidden>
                <a href="/manager/questions/questions-manager.php"><li>Xem tất cả</li></a>
                <a href="#"><li>Thêm mới</li></a>
            </ul>
        </li>
    </ul>
</div>
