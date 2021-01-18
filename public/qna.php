<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "qna");
require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");
// include_once($root_path . "/public/templates/item/item.php");

$qnas = sql_query("
        select *
        from qna;
    ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỏi đáp</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
    <style>
        .panel {
            font-size: 20px;
            margin: 30px 10% 30px 10%;
            background-color: white;
            color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            min-height: 300px;
            min-width: 1000px;
            display: flex;
            justify-content: center;
        }

        .content {
            margin-top: 5%;
            margin-bottom: 5%;
            width: 80%;
            height: 100%;
        }
        .content .question {
            background-color: #599ef7;
            padding: 17px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .content .answer {
            color: black;
            background-color: #e3e3e3;
            padding: 17px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

    </style>
</head>
<body>  
    <?php require_once($root_path . '/public/templates/ui/header.php'); ?>
    <?php require_once($root_path . '/public/templates/ui/menu.php'); ?>
    
    <div class="panel">
        <div style="color: black; padding-top: 20px;">
            <h1>Hỏi đáp</h1>
        </div>
        <div class="content">
            <?php foreach ($qnas as $qna) : ?>
                <div id="question<?php echo $qna['id'] ?>" class="question" onclick="show_answer(<?php echo $qna['id'] ?>)">
                    <?= $qna['question'] ?>
                </div>
                <div id="answer<?php echo $qna['id'] ?>" class="answer" hidden>
                    <?= $qna['answer'] ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php require_once($root_path . '/public/templates/ui/footer.php'); ?>
</body>
<script>
    function show_answer(qna_id) {
        var show_hide_answer = document.getElementById("answer" + qna_id);
        if (show_hide_answer.style.display === "block") {
            show_hide_answer.style.display = "none";
        } else {
            show_hide_answer.style.display = "block";
        }
    }
</script>
</html>