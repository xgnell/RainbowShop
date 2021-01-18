<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/check-admin-signed-in.php");
?>
<link rel="stylesheet" href="/manager/templates/css/header-style.css">
<div id="admin-header">
    <!-- <span class="page-title">Admin</span> -->

    <div class="page-header">
    <nav class="header-menu">
        <ul>
            <a href="/public/home.php">
                <li>
                    <svg class="menu-option-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    <span>Trang chủ khách hàng</span>
                </li>
            </a>
            <a href="/manager/main/main-manager.php">
                <li>
                    <svg class="menu-option-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    <span>Trang chủ admin</span>
                </li>
            </a>
        </ul>
    </nav>

    <div class="user-panel"
        onmouseover="document.getElementById('account-options').style.visibility = 'visible'"
        onmouseleave="document.getElementById('account-options').style.visibility = 'hidden'">
        
        <div class="account-display">
            <!-- <?php
                if (is_admin_signed_in()) {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    <?php
                } else {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    <?php
                }
            ?> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            <a class="user-name">
                <?php
                    if (is_admin_signed_in()) {
                        echo $_SESSION["user"]["admin"]["name"];
                    }
                ?>
            </a>
        </div>
        <!-- Menu con chứa các options của tài khoản -->
        <div id="account-options">
            <ul>
                <a href="/public/display-orders.php"><li>Sửa thông tin</li></a>
                <a href="/manager/main/sign-out.php"><li>Đăng xuất</li></a>
            </ul>
        </div>
    </div>
    </div>
</div>