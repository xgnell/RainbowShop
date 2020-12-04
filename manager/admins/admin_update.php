<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(1);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected admin
    $admin_id = $_GET["id"];
    $admin = mysqli_fetch_array(sql_query("
        SELECT *
        FROM admins
        WHERE id=$admin_id;
    "));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Admin Update</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Admin update form -->
            <form action="/manager/admins/admin_update_process.php" method="POST">
                <input type="number" name="id" value="<?= $admin["id"] ?>" hidden><br>
                Name: <input type="text" name="name" value="<?= $admin["name"] ?>"><br>
                Gender: <select name="gender" id="input_gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                <script>
                    // Set selected for gender options
                    let input_gender_options = document.querySelectorAll("#input_gender option");
                    for (let option of input_gender_options) {
                        if (option.value == <?= $admin['gender'] ?>) {
                            option.selected = "selected";
                            break;
                        }
                    }
                </script>
                Birth: <input type="date" name="birth" value="<?= $admin["birth"] ?>"><br>
                Phone: <input type="text" name="phone" value="<?= $admin["phone"] ?>"><br>
                Email: <input type="text" name="email" value="<?= $admin["email"] ?>"><br>
                Password: <input type="password" name="passwd" value="<?= $admin["passwd"] ?>"><br>
                Rank: <?php
                    $selection = '<select name="rank" id="input_rank">';

                    // Get number of ranks
                    $ranks = sql_query("
                        SELECT max_rank
                        FROM admin_rank;
                    ");
                    $rank = mysqli_fetch_array($ranks);
                    for ($i = 1; $i <= $rank["max_rank"]; $i++) {
                        $selection .= "<option value=$i ";
                        if ($admin["rank"] == $i) $selection .= "selected";
                        $selection .= ">Rank $i</option>";
                    }

                    $selection .= '</select>';

                    echo $selection;
                ?><br>
                
                <input type="submit" value="Confirm">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
</body>
</html>
