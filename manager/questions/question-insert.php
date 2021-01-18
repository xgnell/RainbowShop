<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add questions</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <?php require_once($root_path . "/config/db.php"); ?>
    <style>
        #display-size {
            border: 1px black solid;
            border-collapse: collapse;
            margin: 5px 5px 5px 5px;
        }
        #display-size tr td {
            border: 1px black solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <div>
            <form action="/manager/questions/question-insert-process.php">
                <table>
                    <tr>
                        <td>
                            Nhập câu hỏi:
                        </td>
                        <td>
                            <textarea name="question" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nhập câu trả lời:
                        </td>
                        <td>
                            <textarea name="answer" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="reset" value="Viết lại">
                            <input type="submit" value="Nộp luôn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
