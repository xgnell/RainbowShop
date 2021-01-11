<style>
    #get-info-form {
        visibility: hidden;
        position: fixed;
        display: flex;
        justify-content: center;
        width: 100vw;
        height: 100vh;
        background: rgba(43, 43, 43, 0.5);
        z-index: 3;
    }

    #get-info-form .form-frame {
        margin-top: 100px;
        width: 500px;
        height: 450px;
        text-align: center;
        background-color: white;
        box-shadow: 5px 15px 15px #5c5c5c;
        border-radius: 5px;
        /*border: 1px black solid;*/
    }

    #get-info-form .form-content {
        text-align: left;
        margin: 5px 45px 5px 45px;
    }
    #get-info-form .form-content > input {
        width: 100%;
        height: 50px;
    }

    #get-info-form .form-title {
        font-size: 30px;
        font-weight: bold;
    }

    #get-info-form .btn-close {
        cursor: pointer;
        position: relative;
        left: 220px;
        top: 5px;
    }
    /*#get-info-form .btn-close:hover {
        background-color: rgb(208, 209, 214);
    }*/


    #get-info-form .btn-order {
        cursor: pointer;
        width: 200px;
        height: 50px;
    }

    /* #get-info-form .form-footer {
        display: flex;
        justify-content: space-around;
    }
    #get-info-form .form-footer a {
        padding: 5px 10px 5px 10px;
        border-radius: 3px;
        text-decoration: none;
        color: gray;
    }
    #get-info-form .form-footer a:hover {
        color: black;
        background-color: rgb(208, 209, 214);
    } */
</style>


<div id="get-info-form">
    <div class="form-frame">
        <a class="btn-close" onclick="document.getElementById('get-info-form').style.visibility = 'hidden'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
        </a><br>
        <span class="form-title">Thông tin người nhận</span>
        <form action="/public/templates/process-order.php" method="POST">
            
            <div class="form-content">
            <input type="text" name="id_customer" value="<?= $_SESSION["user"]["customer"]["id"]?>" style="visibility: hidden;">
                <input type="text" name="receiver" placeholder="Tên người nhận"><br><br>
                <input type="text" name="phone" placeholder="Số điện thoại"><br><br>
                <input type="text" name="address" placeholder="Địa chỉ"><br><br>
            </div>
            
            <input class="btn-order" type="submit" value="Đặt hàng"><br><br>
        </form>
    </div>
</div>
