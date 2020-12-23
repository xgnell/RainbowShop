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
        <li>
            <a id="link-search" name="search" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="30px" height="30px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
            </a>
        </li>
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="30px" height="30px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
            </a>
        </li>
        <li>
            <a href="#" style="text-align: center center;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="30px" height="30px"><path d="M0 0h24v24H0z" fill="none"/><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
            </a>
        </li>
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
