<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/default.php");
?>
<script defer>
    const delay_time = 5000;
    let bgs = <?php
        $backgrounds = sql_query("
            select *
            from backgrounds
        ");
        $bgs = [];
        foreach ($backgrounds as $bg) {
            array_push($bgs, $bg['picture']);
        }
        echo json_encode($bgs);
    ?>;
    console.log(bgs);
    let bg_src = "<?= BACKGROUND_IMAGE_SOURCE_PATH ?>";
    let current_bg = 0;
    setInterval(function() {
        change_background(1);
    }, delay_time);
    
    function change_background(direction) {
        switch (direction) {
            case 0:
                // Left
                current_bg--;
                if (current_bg < 0) {
                    current_bg = bgs.length - 1;
                }
                break;
            default:
                // Right
                current_bg++;
                if (current_bg > bgs.length - 1) {
                    current_bg = 0;
                }
                break;
        }
        document.getElementById('display-background').style.backgroundImage = `url("${bg_src + bgs[current_bg]}")`;
    }
</script>
<link rel="stylesheet" href="/public/templates/ui/backgrounds/background.css">
<style>
    #display-background {
        border-radius: 5px;
        width: 100%;
        height: 100%;
        background-image: url("<?= BACKGROUND_IMAGE_SOURCE_PATH . $bgs[0]; ?>");
        background-size: cover;
        background-position: center;
        transition: 0.5s ease;
    }

    .btn-scroll {
        position: absolute;
        cursor: pointer;
    }
</style>


<div class="carousel-container">
    <div class="carousel-slide">
        <div id="display-background"></div>
    </div>
</div>


<a class="btn-scroll" onclick="change_background(0)" style="left: 30px; top: 400px;">
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/></svg>
</a>
<a class="btn-scroll" onclick="change_background(1)" style="right: 30px; top: 400px;">
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/></svg>
</a>
