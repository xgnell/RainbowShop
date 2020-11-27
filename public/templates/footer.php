<style>
    footer {
        background-color: #363e7e;
        color: white;
        display: flex;
    }
    footer .sign-up {
        width: 50%;
    }
    footer .contact {
        width: 50%;
    }
    footer .title {
        margin-top: 15px;
        text-align: center;
    }
</style>
<footer>
    <div class="sign-up">
        <h2 class="title">Đăng kí</h2><br>
        <?php include_once("signup.php"); ?>
    </div>
    <div class="contact">
        <h2 class="title">Liên hệ</h2><br>
        <a href="#"><img width="30" height="30" src="/public/img/socials/facebook-icon.png" alt="Facebook"></a>
        <a href="#"><img width="30" height="30" src="/public/img/socials/google-icon.png" alt="Gmail"></a>
        <a href="#"><img width="30" height="30" src="/public/img/socials/zalo-icon.png" alt="Zalo"></a>
    </div>
</footer>