<link rel="stylesheet" href="/manager/templates/css/header-style.css">
<div id="admin-header">
    <span class="page-title">Dashboard</span>

    <div class="page-header">
    <nav class="header-menu">
        <ul>
            <a href="/public/home.php"><li>Trang chủ khách hàng</li></a>
            <a href="/manager/main/main-manager.php"><li>Trang chủ admin</li></a>
        </ul>
    </nav>

    <div class="user-panel"
        onmouseover="document.getElementById('account-options').style.visibility = 'visible'"
        onmouseleave="document.getElementById('account-options').style.visibility = 'hidden'">
        
        <img class="user-avatar" width="25px" src="/public/img/others/baseline_account_circle_black_18dp.png" alt="User Avatar">
        <a class="user-name" href="#">
            <?php
                require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/check-admin-signed-in.php");
                if (is_admin_signed_in()) {
                    echo $_SESSION["user"]["admin"]["name"];
                }
            ?>
        </a>
        <!-- Menu con chứa các options của tài khoản -->
        <!-- onmouseleave="document.getElementById('account-options').style.visibility = 'hidden'"> -->
        <div id="account-options">
            <!-- <div class="layer"> -->
            <!-- <span class="hello"><?= $_SESSION["user"]["customer"]["name"] ?></span><br> -->
            <ul>
                <!-- <li><a>Profile</a></li> -->
                <li><a href="/public/display-orders.php">Sửa thông tin</a></li>
                <!-- <li><a>Cài đặt</a></li> -->
                <li><a href="/manager/main/sign-out.php">Đăng xuất</a></li>
            </ul>
            <!-- </div> -->
        </div>
    </div>
    </div>
</div>