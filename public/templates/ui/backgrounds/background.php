<?php
    $backgrounds = sql_query("
        select *
        from backgrounds
        where id = 1
    ");
    mysqli_fetch_array($backgrounds);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/templates/ui/backgrounds/background.css">
</head>

<body>
    <div class="carousel-container">
        <div class="carousel-slide">
            <?php foreach ($backgrounds as $background): ?>
                <img src="<?= BACKGROUND_IMAGE_SOURCE_PATH . $background['picture'] ?>" alt="Background">
            <?php endforeach ?>
        </div>
    </div>
<!-- 
    <button id="prev">Prev</button>
    <button id="next">Next</button> -->
    <!-- <script src="background.js"></script> -->
</body>

</html>