<style>
    #nav-menu {
        width: 100%;
        line-height: 60px;
        background-color: #363e7e;
    }
    #nav-menu .menu-logo {
        font-size: 30px;
        font-weight: bold;
        color: white;
        line-height: 60px;
        padding: 0 50px;
    }
    #nav-menu ul {
        float: right;
    }
    #nav-menu ul li {
        display: inline-block;
        margin: 0 15px 0 15px;
    }
    #nav-menu ul li a {
        color: white;
        font-size: 17px;
        padding: 14px 20px 14px 20px;
        text-transform: uppercase;
        border-radius: 7px;
    }
    #nav-menu ul li a:hover {
        background-color: #1a008c;
        transition: 0.5s;
    }
    #nav-menu .current-option {
        background-color: #1a008c;
    }
</style>
<nav id="nav-menu">
    <label class="menu-logo">Rainbow Kitty</label>
    <ul>
        <li><a id="link-intro" name="home" href="/public/home.php">Giới thiệu</a></li>
        <li><a id="link-order" name="order" href="#">Đặt hàng</a></li>
        <li><a id="link-contact" name="contact" href="/public/contact.php">Liên hệ</a></li>
        <li><a id="link-qna" name="questions" href="#">Hỏi đáp</a></li>
        <!-- <li><a href="#">Giỏ hàng</a></li>
        <li><a href="#">Đăng nhập</a></li> -->
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
</nav>
