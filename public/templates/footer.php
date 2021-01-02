<style>
    #div_all_footer {
        background-color: #363e7e;
        color: white;
        height: 400px;
        position: relative;
        /* display: flex; */
    }
    #div_content_inside {
        width: 80%;
        height: 80%;
        display: flex;
        margin-top: 10px;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .title {
        font-family: Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    /*#div_content_inside .sign-up {
        width: 33%;
    }*/
    #div_content_inside .contact {
        width: 34%;
    }
    .icon{
        margin-right: 60px;
    }
    #div_content_inside .map {
        width: 33%;
    }
</style>

<div id="div_all_footer">
    <div id="div_content_inside">
        <!-- <div class="sign-up">
            <h2 class="title">Đăng kí</h2><br>
            <div>
                <?php //include_once("sign-up.php"); ?>
            </div>
        </div> -->

        <div class="contact">
            <h2 class="title">Liên hệ</h2><br>
            <div>
                <a href="#" class="icon">
                    <img width="50" height="50" src="/public/img/socials/facebook-icon.png" alt="Facebook">
                </a>
                <a href="#" class="icon">
                    <img width="50" height="50" src="/public/img/socials/google-icon.png" alt="Gmail">
                </a>
                <a href="#" class="icon">
                    <img width="50" height="50" src="/public/img/socials/zalo-icon.png" alt="Zalo">
                </a>
            </div>
        </div>

        <div class="map">
            <h2 class="title">Địa chỉ</h2><br>
            <div>
                <h4 class="title">
                    A17 Lê Thanh Nghị, Hai Bà Trưng, Hà Nội
                </h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7617995886294!2d105.84454931533641!3d21.00218339406003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe0dd0b2919d48ce9!2zSOG7jWMgdmnhu4duIENOVFQgQsOhY2ggS2hvYQ!5e0!3m2!1svi!2s!4v1609259670369!5m2!1svi!2s" width="440" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>