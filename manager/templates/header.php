<style>
    /* General */
    #admin-header {
        background-color: #32373c;
        color: #eee;
        line-height: 35px;
        width: 100%;
        display: flex;
    }

    /* Display page title */
    #admin-header .page-title {
        font-size: 25px;
        margin-left: 15px;
    }

    /* Display header menu */
    #admin-header .header-menu {
        margin-left: 7px;
        font-size: 20px;
    }
    #admin-header .header-menu ul li {
        display: inline-block;
        margin: 0 10px 0 10px;
        padding: 0px 10px 0px 10px;
    }
    #admin-header .header-menu ul li:hover {
        background-color: #585959;
    }
    #admin-header .header-menu ul li a {
        color: white;
    }

    /* Display User Account */
    #admin-header .user-panel {
        /* position: relative;
        top: 0px;
        right: 0px; */
        margin-right: 15px;
        padding: 0 10px 0 10px;
    }
    #admin-header .user-panel:hover {
        background-color: #585959;
    }
    #admin-header .user-panel * {
        margin: 0 5px 0 5px;
        vertical-align: middle;
    }
    #admin-header .user-panel .user-name {
        font-size: 20px;
    }
</style>
<div id="admin-header">
    <span class="page-title">Dashboard</span>
    <nav class="header-menu">
        <ul>
            <li><a href="/public/home.php">Home page</a></li>
            <li><a href="/manager/main/main_manager.php">Admin page</a></li>
        </ul>
    </nav>
    <div class="user-panel">
        <img class="user-avatar" width="25px" src="/public/img/others/baseline_account_circle_black_18dp.png" alt="User Avatar">
        <span class="user-name">User name</span>
    </div>
</div>