<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

    define("MENU_OPTION", "qna");
    $notification_title = "Quản lý câu hỏi";
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
    require_once($root_path . "/manager/templates/notification-page.php");


    // Get selected customer
    $qna_id = $_GET["id"] ?? null;
    if ($qna_id == null) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay lại trang trước đó
        );
        exit();
    }
    
    /* Kiểm tra tính hợp lệ của id */
    if (!is_numeric($qna_id)) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay lại trang trước đó
        );
        exit();
    }
    $qna_id_db = sql_query("
        SELECT *
        FROM qna
        WHERE id = {$qna_id};
    ");
    if (mysqli_num_rows($qna_id_db) != 1) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay lại trang trước đó
        );
        exit();
    }

    $qna = mysqli_fetch_array(sql_query("
        SELECT *
        FROM qna
        WHERE id=$qna_id;
    "));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <script src="/manager/templates/js/common-validate.js"></script>
    <title>Quản lý câu hỏi</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Customer update form -->
            <form onsubmit="return validate_simple(['question', 'answer']);"
                action="/manager/questions/question-update-process.php" method="POST">
                <input type="number" name="id" value="<?= $qna["id"] ?>" hidden>
                <table class="edit-table">
                    <tr>
                        <td class="table-title" rowspan="2">
                            Câu hỏi:
                        </td>
                        <td>
                            <textarea name="question" id="input-question"><?= htmlspecialchars_decode($qna["question"]) ?></textarea><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-question"></td>
                    </tr>

                    <tr>
                        <td class="table-title" rowspan="2">
                            Câu trả lời:
                        </td>
                        <td>
                            <textarea name="answer" id="input-answer"><?= htmlspecialchars_decode($qna["answer"]) ?></textarea><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-answer"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Xác nhận sửa">
                                <input type="reset" value="Làm lại">
                            </div>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
</body>
</html>