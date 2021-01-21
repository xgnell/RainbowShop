<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected customer
    $qna_id = $_GET["id"];
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
            <form action="/manager/questions/question-update-process.php" method="POST">
            <input type="number" name="id" value="<?= $qna["id"] ?>" hidden>
            <table class="edit-table">
                <tr>
                    <td class="table-title" rowspan="2">
                        Câu hỏi:
                    </td>
                    <td>
                        <textarea name="question" cols="30" rows="5"><?= $qna["question"] ?></textarea><br>
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
                        <textarea name="answer" cols="30" rows="5"><?= $qna["answer"] ?></textarea><br>
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