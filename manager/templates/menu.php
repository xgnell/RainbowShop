<style>
    /* General */
    #page-menu {
        position: relative;
        background-color: #32373c;
        color: #eee;
        height: 100%;
        width: 200px;
        padding-top: 15px;
    }
    #page-menu * {
        color: #eee;
        font-size: 20px;
    }

    /* Main menu */
    #page-menu .main-menu li {
        width: 100%;
        padding: 5px 0 5px 15px;
        margin-bottom: 10px;
        position: relative;
    }
    #page-menu .main-menu li:hover {
        background-color: #585959;
    }
    #page-menu .main-menu li:hover .sub-menu {
        display: block;
    }

    /* Sub menu */
    #page-menu .sub-menu {
        display: none;
        position: absolute;
        left: 130px;
        top: 0px;
        background-color: #32373c;
        width: 150px;
    }
</style>
<div id="page-menu">
    <ul class="main-menu">
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/check_signed_in.php"); ?>
        <?php if (is_admin_rank(1)) { ?>
        <li>
            <a href="#">Admins</a>
            <ul class="sub-menu" hidden>
                <li><a href="/manager/admins/admins_manager.php">All Admins</a></li>
                <li><a href="/manager/admins/admin_insert.php">Add Admin</a></li>
                <!-- <li><a href="#">Update Admin</a></li> -->
                <!-- <li><a href="#">Delete Admin</a></li> -->
            </ul>
        </li>
        <?php } ?>
        <li>
            <a href="#">Customers</a>
            <ul class="sub-menu" hidden>
                <li><a href="/manager/customers/customers_manager.php">All Customers</a></li>
                <li><a href="/manager/customers/customer_insert.php">Add Customer</a></li>
                <!-- <li><a href="#">Update Customer</a></li> -->
                <!-- <li><a href="#">Delete Customer</a></li> -->
            </ul>
        </li>
        <li>
            <a href="#">Questions</a>
            <ul class="sub-menu" hidden>
                <li><a href="/manager/questions/questions_manager.php">All Questions</a></li>
                <li><a href="#">Add</a></li>
                <!-- <li><a href="#">Update</a></li> -->
                <!-- <li><a href="#">Delete</a></li> -->
            </ul>
        </li>
    </ul>
</div>
<script>
    let menu_options = document.querySelectorAll('#page-menu .main-menu > li');
    for (let option of menu_options) {
        option.is_opened = false;
        let children = option.children;

        // Get <a> tag
        let option_name = children[0];
        // Get <ul> tag -> submenu
        let submenu = children[1];

        // Set events
        option_name.onclick = function() {
            if (option.is_opened) {
                // Close submenu
                submenu.hidden = true;
                option.is_opened = false;
            } else {
                // Open submenu
                submenu.hidden = false;
                option.is_opened = true;
            }
            
        }

    }
</script>
