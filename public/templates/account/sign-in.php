<style>
    #sign-in-form {
        visibility: hidden;
        position: fixed;
        display: flex;
        justify-content: center;
        width: 100vw;
        height: 100vh;
        background: rgba(43, 43, 43, 0.5);
        z-index: 10;
    }

    #sign-in-form .form-frame {
        margin-top: 150px;
        width: 500px;
        height: 400px;
        text-align: center;
        background-color: white;
        box-shadow: 5px 15px 15px #5c5c5c;
        border-radius: 5px;
        /*border: 1px black solid;*/
    }

    #sign-in-form .form-content {
        text-align: left;
        margin: 5px 45px 5px 45px;
    }
    #sign-in-form .form-content > input {
        width: 100%;
        height: 50px;
    }

    #sign-in-form .form-title {
        font-size: 30px;
        font-weight: bold;
    }

    #sign-in-form .btn-close {
        cursor: pointer;
        position: relative;
        left: 220px;
        top: 5px;
    }
    /*#sign-in-form .btn-close:hover {
        background-color: rgb(208, 209, 214);
    }*/


    #sign-in-form .btn-sign-in {
        cursor: pointer;
        width: 200px;
        height: 50px;
    }

    #sign-in-form .form-footer {
        display: flex;
        justify-content: space-around;
    }
    #sign-in-form .form-footer a {
        padding: 5px 10px 5px 10px;
        border-radius: 3px;
        text-decoration: none;
        color: gray;
    }
    #sign-in-form .form-footer a:hover {
        color: black;
        background-color: rgb(208, 209, 214);
    }
</style>


<div id="sign-in-form">
    <div class="form-frame">
        <a class="btn-close" onclick="document.getElementById('sign-in-form').style.visibility = 'hidden'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
        </a><br>
        <span class="form-title">Đăng nhập</span><br><br>
        <form action="/public/templates/account/sign-in-process.php" method="POST">
            
            <div class="form-content">
                <input type="text" name="email" placeholder="Email"><br><br>
                <input type="password" name="passwd" placeholder="Mật khẩu"><br><br>
            </div>
            
            <input class="btn-sign-in" type="submit" value="Đăng nhập"><br><br>

            <div class="form-footer">
                <a href="/public/templates/account/sign-up.php">Tạo tài khoản mới</a>
                <a href="/public/templates/account/forget-account.php">Quên tài khoản ?</a>
            </div>
        </form>
    </div>
</div>


<!-- <script>
    function add_item_to_cart() {
        <?php
        if (customer_signed_in()) {
            ?>
            return true;
            // window.location.href = `/public/templates/item-detail.php?id=${item_id}`;
            <?php
        } else {
            ?>
            document.getElementById('sign-in-form').style.visibility = 'visible';
            return false;
            <?php
        }
        ?>
    }
</script> -->
