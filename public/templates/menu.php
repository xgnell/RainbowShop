<style>
    /* All menu */
    /*.menu {
        top: 0;
        width: 100%;
    }*/
    #menu {
        z-index: 2;
        position: absolute;
        top: 80px;
        width: 100%;
        background-color: #21264f;
        /*transition: top 0.3s;*/
    }
    #nav-menu {
        margin: auto;
        width: 80%;
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
        border-bottom: 4px #ebb12a solid;
    }

    /* Display highlight current selected option */
    #nav-menu .current-option {
        border-bottom: 4px #ebb12a solid;
    }

    /*#search {
        position: sticky;
        top: 0;
        width: 100%;
        height: 50px;
        background-color: green;
    }*/

    #scroll-top-btn {
        visibility: hidden;
        z-index: 5;
        color: red;
        position: fixed;
        right: 30px;
        bottom: 30px;
        padding: 10px 10px 10px 10px;
        border-radius: 50px;
        background-color: #21264F;
    }
</style>
<div id="menu">
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
</div>

<!-- <div id="search">
    Demo search bar
</div> -->

<a href="#nav-header" id="scroll-top-btn" >
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>
</a>

<script>
    let prevScrollPos = window.pageYOffset;
    const limit_menu = 80;
    const menu = document.getElementById('menu');
    let is_scrolled_down = false;

    const limit_scroll_btn = 300;
    const scroll_top_btn = document.getElementById('scroll-top-btn');
    let is_below = false;

    window.onscroll = function() {
        // Check for menu sticky
        if (window.pageYOffset > limit_menu) {
            if (is_scrolled_down === false) {
                menu.style.position = 'fixed';
                menu.style.top = '0px';
                setTimeout(() => {
                    menu.style.transition = 'top 0.3s';
                }, 5);
                // menu.style.transition = 'top 0.3s';
                is_scrolled_down = true;
            }
            const currentScrollPos = window.pageYOffset;
            if (prevScrollPos > currentScrollPos) {
                menu.style.top = "0";
            } else {
                menu.style.top = "-50px";
            }
            prevScrollPos = currentScrollPos;
        } else {
            if (is_scrolled_down === true) {
                menu.style.position = 'absolute';
                menu.style.top = '80px';
                menu.style.transition = null;
                is_scrolled_down = false;
            }
        }

        // Check for scroll button appearance
        if (window.pageYOffset > limit_scroll_btn && is_below === false) {
            is_below = true;
            scroll_top_btn.style.visibility = 'visible';
        } else if (window.pageYOffset < limit_scroll_btn && is_below === true) {
            is_below = false;
            scroll_top_btn.style.visibility = 'hidden';
        }
    }
</script>