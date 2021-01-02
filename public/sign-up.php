<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "signup");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Sign up</title>
    <style>
        .page-body {
            display: flex;
            justify-content: flex-end;
        }

        .panel {
            right: 30px;
            margin: 30px 200px 30px 30px;
            width: 450px;
            /*height: 700px;*/
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            padding: 20px 30px 20px 30px;
        }

        .form-title {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            font-size: 1em;
            font-style: italic;
        }

        input {
            margin-top: 5px;
            width: 100%;
            height: 50px;
        }
    </style>
</head>
<body>
    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/menu.php"); ?>

    <div class="page-body">
    <div class="panel">
        <div class="form-title">Sign up</div>
        <form action="/public/sign-up-process.php" method="POST">
            <label>Name</label><span class="error"></span><br>
            <input type="text" name="name"><br><br>

            <label>Email</label><span class="error"></span><br>
            <input type="email" name="email"><br><br>

            <label>Gender</label><span class="error"></span><br>
            <select name="gender">
                <option value="0">Nữ</option>
                <option value="1">Nam</option>
            </select><br><br>

            <label>Password</label><span class="error"></span><br>
            <input type="password" name="passwd" placeholder="Password"><br><br>
            
            <label>Address</label><span class="error"></span><br>
            <input type="text" name="address"><br><br>

            <label>Birth</label><span class="error"></span><br>
            <input type="date" name="birth"><br><br>

            <label>Phone</label><span class="error"></span><br>
            <input type="number" name="phone"><br><br>

            <input class="btn-sign-up" type="submit" value="Sign up"><br><br>

        </form>
    </div>
    </div>

    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>