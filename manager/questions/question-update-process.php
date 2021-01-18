<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get all input data
    $qna_id = $_POST["id"];
    $qna_question = $_POST["question"];
    $qna_answer = $_POST["answer"];

    // Update selected customer in database
    sql_cmd("
        UPDATE qna
        SET question = '$qna_question', answer = '$qna_answer'
        WHERE id = '$qna_id';
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Update Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/questions/question-notification.php") ?>
</body>
</html>
