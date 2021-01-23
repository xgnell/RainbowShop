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
            /* display: flex;
            justify-content: center; */
        }
        .panel .title {
            color: black;
            width: 80%;
            padding-top: 20px;
            padding-bottom: 20px;
            margin: auto;
        }

        .panel .content {
            margin-top: 5%;
            margin-bottom: 5%;
            width: 80%;
            height: 100%;
            margin: auto;
            padding-bottom: 30px;
        }
        .panel .content .question {
            background-color: #599ef7;
            padding: 17px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .panel .content .answer {
            color: black;
            background-color: #e3e3e3;
            padding: 17px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }

    </style>
</head>
<body>  
    <?php require_once($root_path . '/public/templates/ui/header.php'); ?>
    <?php require_once($root_path . '/public/templates/ui/menu.php'); ?>
    
    <div class="panel">
        <div class="title">
            <h1>Hỏi đáp</h1>
        </div>
        <div class="content">
            <?php foreach ($qnas as $qna) : ?>
                <div id="question<?php echo $qna['id'] ?>" class="question" onclick="show_answer(<?php echo $qna['id'] ?>)">
                    <?= $qna['question'] ?>
                    <span style="float: right;" id="navigation<?php echo $qna['id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                    </span>
                </div>
                <div id="answer<?php echo $qna['id'] ?>" class="answer">
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
            document.getElementById("navigation" + qna_id).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>';
        } else {
            show_hide_answer.style.display = "block";
            document.getElementById("navigation" + qna_id).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>';
        }
    }
</script>
</html>