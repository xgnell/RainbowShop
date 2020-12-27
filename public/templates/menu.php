<style>
    /* All menu */
    #nav-menu {
        width: 100%;
        line-height: 50px;
        background-color: #21264f;
    }

    /* Options */
    #nav-menu ul {
        display: flex;
        justify-content: space-around;
    }
    #nav-menu ul li {
        display: inline-block;
        margin: 0 15px 0 15px;
    }
    #nav-menu ul li a {
        color: white;
        font-size: 17px;
        padding: 10px 10px 10px 10px;
        text-transform: uppercase;
        font-weight: bold;
    }
    /* Hover an option */
    #nav-menu ul li a:hover {
        border-bottom: 4px #ffffff solid;
    }

    /* Display highlight current selected option */
    #nav-menu .current-option {
        border-bottom: 4px #ffffff solid;
    }
</style>
<div id="nav-menu">
    <ul>
        <li><a id="link-intro" name="home" href="/public/home.php">Giới thiệu</a></li>
        <li><a id="link-order" name="order" href="#">Đặt hàng</a></li>
        <li><a id="link-contact" name="contact" href="/public/contact.php">Liên hệ</a></li>
        <li><a id="link-qna" name="questions" href="#">Hỏi đáp</a></li>
    </ul>
    <script>
        let menu_options = document.querySelectorAll("#nav-menu > ul > li > a");
        for (let option of menu_options) {
            if (option.name == "<?php if (PAGE_NAME !== null) { echo PAGE_NAME; } ?>") {
                option.classList.add("current-option");
                break;
            }
        }
    </script>
</div>
