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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý câu hỏi</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
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
            <?php
            $qnas = sql_query("
                    SELECT *
                    FROM qna;
                ");
            ?>

            <div class="scrollable">
                <table id="content-table">
                    <tr class="table-bar">
                        <!-- <td hidden class="title">Id</td> -->
                        <td>Câu hỏi</td>
                        <td>Câu trả lời</td>

                        <td>Sửa</td>
                        <td>Xóa</td>
                    </tr>
                    <?php foreach ($qnas as $qna) : ?>
                        <tr>
                            <td><?= $qna['question'] ?></td>
                            <td><?= $qna['answer'] ?></td>

                            <td><a href="/manager/questions/question-update.php?id=<?= $qna['id'] ?>">Update</a></td>
                            <td><a href="/manager/questions/question-delete-process.php?id=<?= $qna['id'] ?>">Delete</a></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <br>
            <!-- <a href="#">Add new</a> -->
        </div>
    </div>
</body>

</html>