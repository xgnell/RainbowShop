<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/manager/templates/notification-page.php");
    if (basename($_SERVER['PHP_SELF']) == "header.php") {
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
<style>
    #nav-slide-menu {
        position: fixed;
        top: 0;
        left: 0;
        background-color: #4a3f6e;
        height: 100%;
        width: 250px;
        margin-left: -250px;
        transition: 0.5s;
    }
    #nav-slide-menu ul {
        margin-top: 15px;
    }
    #nav-slide-menu ul li {
        font-size: 20px;
        color: white;
    }
    .slide-menu-arrow {
        position: fixed;
        top: 50%;
        margin-left: 0px;
        transition: 0.5s;
    }
</style>
<div id="nav-slide-menu">
    <ul>
        <li>Sản phẩm mới</li>
        <li>Sản phẩm nổi bật</li>
    </ul>
</div>
<img class="slide-menu-arrow" onclick="click_arrow()" src="/public/img/others/arrow_forward_ios-24px.svg" width="30" height="30">
<script defer>
    function open_menu() {
        document.querySelector("#nav-slide-menu").style.marginLeft = "0px";
        document.querySelector(".slide-menu-arrow").style.marginLeft = "255px";
        document.querySelector(".slide-menu-arrow").src = "/public/img/others/arrow_back_ios-24px.svg";
    }

    function close_menu() {
        document.querySelector("#nav-slide-menu").style.marginLeft = "-250px";
        document.querySelector(".slide-menu-arrow").style.marginLeft = "0px";
        document.querySelector(".slide-menu-arrow").src = "/public/img/others/arrow_forward_ios-24px.svg";
    }

    let isOpen = false;
    function click_arrow() {
        if (!isOpen) {
            isOpen = true;
            open_menu();
        } else {
            isOpen = false;
            close_menu();
        }
    }
</script>