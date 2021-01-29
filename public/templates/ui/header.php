<style>
    #nav-header {
        width: 100%;
        height: 80px;
        line-height: 100px;
        background-color: #363e7e;
        /* margin: auto;
        z-index: 999; */
        /* margin-bottom: 90px; */
        /* min-width: 1000px; */
    }

    #nav-header .logo-name {
        float: left;
        height: 100%;
        color: white;
        margin-top: -10px;
        margin-left: 10px;
        font-size: 36px;
    }

    #nav-header .header-logo {
        margin-left: 100px;
        margin-top: 5px;
        width: 70px;
        height: 70px;
        font-size: 30px;
        font-weight: bold;
        line-height: 60px;
        float: left;
        background-image: url('/public/assets/logos/rainbow-kitty.png');
        /* z-index: 999; */
        background-size: cover;
    }

    /* #nav-header .menu-cart-account {
        padding-right: 80px;
    } */
    #nav-header ul {
        float: right;
        height: 100%;
        margin-right: 100px;
    }

    #nav-header ul li {
        display: inline-block;
        margin-left: 15px;
        margin-right: 15px;
    }

    #nav-header ul li a {
        color: white;
        /* font-size: 10px; */
        /* padding: 14px 20px 14px 20px; */
        text-transform: uppercase;
        /* border-radius: 7px; */
    }

    #nav-header .header-menu ul li a {
        cursor: pointer;
    }
</style>

<?php
if (customer_signed_in()) {
    include_once($root_path . "/public/templates/account/account-options.php");
} else {
    include_once($root_path . "/public/templates/account/sign-in.php");
}

require_once($root_path . "/manager/templates/check-admin-signed-in.php");
if (is_admin_signed_in()) {
    include_once($root_path . "/manager/templates/header.php");
}
?>
<div id="nav-header">
    <!-- Here is logo -->
    <div class="header-logo">
        <a></a>
    </div>
    <span class="logo-name">
        Rainbow Kitty
    </span>

    <!-- Here is header menu -->
    <div class="header-menu">
        <ul>
            <!-- Search -->
            <!-- <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                </a>
            </li> -->

            <!-- Sign in -->
            <li>
                <?php
                if (customer_signed_in()) {
                ?>
                    <!-- Display customer avatar -->
                    <a onmouseover="document.getElementById('account-options').style.visibility = 'visible'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </a>
                <?php
                } else {
                ?>
                    <a onclick="sign_in_action()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </a>
                <?php
                }
                ?>
            </li>

            <!-- Cart -->
            <a href="#" onclick="go_to_cart_page()">
                <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                </li>
                
            </a>
        </ul>
    </div>
</div>

<script>
    const sign_in_form = document.getElementById('sign-in-form');
    const get_info_form = document.getElementById('get-info-form');

    window.onclick = function(event) {        
        if (event.target == sign_in_form) {
            clear_all_signin_errors();
            sign_in_form.style.visibility = 'hidden';
        } else if (event.target == get_info_form) {
            clear_all_info_errors();
            get_info_form.style.visibility = 'hidden';
        }
    }

    function sign_in_action() {
        <?php
        if (!customer_signed_in()) {
        ?>
            document.getElementById('sign-in-form').style.visibility = 'visible';
        <?php
        }
        ?>
    }

    function go_to_cart_page() {
        <?php
            if (customer_signed_in()) {
                ?>
                window.location.href = "/public/display-cart.php";
                <?php
            } else {
                ?>
                document.getElementById('sign-in-form').style.visibility = 'visible';
                <?php
            } 
        ?>
    }
</script>
