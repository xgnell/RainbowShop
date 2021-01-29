<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
// require_once($root_path . "/manager/templates/check-admin-signed-in.php");
require_once($root_path . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "pagination-footer.php") {
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
<link rel="stylesheet" href="/manager/templates/css/pagination-style.css">
<div class="pagination-container">
    <?php
        if ($page > 1) {
            ?>
            <a class="page-direction" href="?page=<?= $page - 1 ?>">
                <svg style="position: relative; margin-left: 6px;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/></svg>
            </a>
            <?php
        }
    ?>
    <?php
        for ($i = 1; $i <= $number_of_page; $i++ ) {
            ?>
                <a class="page-number <?php if ($page == $i) echo "current-page"; ?>" href="?page=<?= $i ?>">
                    <?= $i ?>
                </a>
            <?php
        }
    ?>

    <?php
        if ($page < $number_of_page) {
            ?>
            <a class="page-direction" href="?page=<?= $page + 1 ?>">
                <svg style="position: relative; margin-left: 1px;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/></svg>
            </a>
            <?php
        }
    ?>
</div>