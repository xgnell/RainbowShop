<style>
    #nav-header {
        width: 100%;
        line-height: 60px;
        background-color: #363e7e;
    }
    #nav-header .menu-logo {
        font-size: 30px;
        font-weight: bold;
        color: white;
        line-height: 60px;
        padding: 0 50px;
    }
    #nav-header ul {
        float: right;
    }
    #nav-header ul li {
        display: inline-block;
        margin: 10px 15px 10px 15px;
    }
    #nav-header ul li a {
        color: white;
        font-size: 17px;
        padding: 14px 20px 14px 20px;
        text-transform: uppercase;
        border-radius: 7px;
    }
</style>
<div id="nav-header">
    <label class="menu-logo">Rainbow Kitty</label>
    <ul>
        <li>
            <a href="/public/templates/display-cart.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
            </a>
        </li>

        <li>
            <a id="sign-in-option" href="#" onclick="sign_in_action()">
                <?php
                    if (customer_signed_in()) {
                        ?>
                        <!-- Display customer name or avatar -->
                        Hello <?= $_SESSION["user"]["customer"]["name"] ?>
                        <!-- Display action popup when hover -->
                        <!-- <script defer>
                            const sign_in_option = document.getElementById('sign-in-action');
                            sign_in_action.addEventListner('mouseover', function() {

                            });
                        </script> -->
                        <?php
                    } else {
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                        <?php
                    }
                ?>
            </a>
        </li>
    </ul>
    <script>
        function sign_in_action() {
            <?php
                if (customer_signed_in()) {
                    ?>
                    // Display customer account popup manager
                    <?php
                } else {
                    ?>
                    document.getElementById('sign-in-form').hidden = false;
                    <?php
                }
            ?>
        }
    </script>
</div>
