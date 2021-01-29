<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

    define("MENU_OPTION", "qna");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý câu hỏi</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <script src="/manager/templates/js/common-validate.js"></script>
    <?php require_once($root_path . "/config/db.php"); ?>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <form onsubmit="return validate_simple(['question', 'answer']);"
                action="/manager/questions/question-insert-process.php" method="POST">
                
                <table class="edit-table">
                    <tr>
                        <td class="table-title" rowspan="2">
                            Câu hỏi:
                        </td>
                        <td>
                            <textarea name="question" id="input-question"></textarea>
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
                            <textarea name="answer" id="input-answer"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-answer"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Thêm mới">
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
