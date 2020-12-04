<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(1);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get number of ranks
    $ranks = sql_query("
        SELECT max_rank
        FROM admin_rank;
    ");
    $rank = mysqli_fetch_array($ranks);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Add Admin</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Admin insertion form -->
            <form action="/manager/admins/admin_insert_process.php" method="POST">
                Enter name: <input type="text" name="name"><br>
                Choose gender: <select name="gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                Enter birth: <input type="date" name="birth"><br>
                Enter phone: <input type="text" name="phone"><br>
                Enter email: <input type="text" name="email"><br>
                Enter password: <input type="password" name="passwd"><br>
                Choose rank: <select name="rank" id="input_rank">
                    <!-- Auto generate -->
                </select>
                <br>
                <input type="submit" value="Sign up">
                <input type="reset" value="Reset">
            </form>

            <script>
                // Generate options for rank
                let input_rank = document.getElementById("input_rank");
                let option_builder = "";
                for (let i = 1; i <= <?= $rank["max_rank"] ?>; i++) {
                    option_builder += `<option value=${i}>Rank ${i}</option>`;
                }
                input_rank.innerHTML = option_builder;
            </script>
        </div>
    </div>
</body>
</html>
