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
    <title>Questions manager</title>
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
                    <tr>
                        <!-- <td hidden class="title">Id</td> -->
                        <td class="title">Câu hỏi</td>
                        <td class="title">Câu trả lời</td>

                        <td class="title">Update</td>
                        <td class="title">Delete</td>
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
            <a href="#">Add new</a>
        </div>
    </div>
</body>

</html>