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

    $sql_phone = "
        select *
        from contact
        where id = 1
    ";
    $sql_address = "
        select *
        from contact
        where id = 2
    ";
    $phone = mysqli_fetch_array(sql_query($sql_phone));
    $address = mysqli_fetch_array(sql_query($sql_address));
?>
<style>
    #div_all_footer {
        background-color: #363e7e;
        color: white;
        position: relative;
        height: 300px;
        min-width: 1000px;
        /* display: flex; */
    }
    #div_content_inside {
        width: 80%;
        height: 80%;
        display: flex;
        margin-top: 10px;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .title {
        font-family: Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    #div_content_inside .contact {
        width: 34%;
    }
    .icon{
        margin-right: 60px;
    }
    #div_content_inside .map {
        width: 33%;
    }
</style>

<div id="div_all_footer">
    <div id="div_content_inside">
        <div>
            <h2 class="title">Liên hệ</h2><br>
            <span style="font-weight: bold;">Tổng đài hỗ trợ</span>: <br>
            <?= $phone["value"] ?>
            <br>
            <br>
            <span style="font-weight: bold;">Địa chỉ</span>: <br>
            <?= $address["value"] ?>
        </div>
    </div>
</div>