<style>
    #get-info-form {
        visibility: hidden;
        position: fixed;
        display: flex;
        justify-content: center;
        width: 100vw;
        height: 100vh;
        background: rgba(43, 43, 43, 0.5);
        z-index: 10;
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
        border: 1px #ccc solid;
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

    .error-input {
        border: 1px red solid !important;
    }

    .text-display-error {
        color: red;
    }
</style>


<div id="get-info-form">
    <div class="form-frame">
        <a class="btn-close" onclick="clear_all_info_errors(); document.getElementById('get-info-form').style.visibility = 'hidden'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
        </a><br>
        <span class="form-title">Thông tin người nhận</span><br><br>
        <form action="/public/templates/order/process-order.php" method="POST">
            <div class="form-content">
                <input style="padding-left: 10px;" type="text" name="receiver" placeholder="Tên người nhận" id="receiver">
                <div id="display-error-receiver" class="text-display-error"></div>
                <br>
                
                <input style="padding-left: 10px;" type="text" name="phone" placeholder="Số điện thoại" id="phone">
                <div id="display-error-phone" class="text-display-error"></div>
                <br>
                
                <input style="padding-left: 10px;" type="text" name="address" placeholder="Địa chỉ" id="address">
                <div id="display-error-address" class="text-display-error"></div>
                <br>
            </div>
            
            <input class="btn-order" type="submit" value="Đặt hàng" onclick="return submit_order()"><br><br>
        </form>
    </div>
</div>

<script>
    function removeAscent (str) {
    if (str === null || str === undefined) return str;
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        return str;
    }
    function check_receiver() {
        var receiver = document.getElementById("receiver").value;
        var receiver_pattern = /^[a-zA-Z ]{2,}$/g;
        if (receiver_pattern.test(removeAscent(receiver))) {
            document.getElementById("receiver").classList.remove('error-input');
            document.getElementById("display-error-receiver").innerHTML = '';
            return true;
        } else {
            document.getElementById("receiver").classList.add('error-input');
            document.getElementById("display-error-receiver").innerHTML = '* Tên chưa đúng';
            return false;
        }
    }
    function check_address() {
        var address = document.getElementById("address").value;
        var address_pattern = /^[A-Za-z0-9 ]{2,}$/g;
        if (address_pattern.test(removeAscent(address))) {
            document.getElementById("address").classList.remove('error-input');
            document.getElementById("display-error-address").innerHTML = '';
            return true;
        } else {
            document.getElementById("address").classList.add('error-input');
            document.getElementById("display-error-address").innerHTML = '* Địa chỉ chưa đúng';
            return false;
        }
    }
    function check_phone() {
        var phone = document.getElementById("phone").value;
        var phone_pattern = /^(03|05|07|08|09)+([0-9]{8})\b$/;
        if (phone_pattern.test(phone)) {
            document.getElementById("phone").classList.remove('error-input');
            document.getElementById("display-error-phone").innerHTML = '';
            return true;
        } else {
            document.getElementById("phone").classList.add('error-input');
            document.getElementById("display-error-phone").innerHTML = '* Số điện thoại chưa đúng';
            return false;
        }
    }

    function submit_order() {
        check_receiver();
        check_phone();
        check_address();
        if (check_receiver() && check_phone() && check_address()) {
            return true;
        } else {
            return false;
        }
    }


    function clear_all_info_errors() {
        document.getElementById("receiver").classList.remove('error-input');
        document.getElementById("address").classList.remove('error-input');
        document.getElementById("phone").classList.remove('error-input');
    }
</script>
