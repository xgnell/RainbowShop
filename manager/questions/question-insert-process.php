<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get all input data
    $question = $_GET["question"];
    $answer = $_GET["answer"];

    // Insert new customer into database
    sql_cmd("
        insert into qna(question, answer)
        value ('$question', '$answer');
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Questions process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/questions/question-notification.php") ?>
</body>
</html>