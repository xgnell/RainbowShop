<style>
    #div-sign-up {
        /* display: flex; */
        margin: auto;
    }
    #div-sign-up form {
        margin: auto;
    }
    #div-sign-up form .all{
        width: 90%;
        margin-top: 0px;
    }
    #div-sign-up .input-data input {
        width: 400px;
        height: 50px;
        margin-bottom: 10px;
        margin-top: 10px;
        font-size: 17px;
    }
    #div-sign-up .input-action {
        display: flex;
        justify-content: space-between;
    }
    #div-sign-up .input-action input {
        margin-bottom: 10px;
        margin-top: 10px;
        width: 170px;
        height: 50px;
        font-size: 15px;
    }
</style>
<div id="div-sign-up">
    <form>
        <div class="all">
            <div class="input-data">
                <input type="text" placeholder="Nhập Email"><br>
                <input type="password" placeholder="Nhập mật khẩu"><br>
            </div>
            <div class="input-action">
                <input type="submit" value="Đăng kí">
                <input type="reset" value="Nhập lại">
            </div>
        </div>
    </form>
</div>