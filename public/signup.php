<style>
    #div-sign-up {
        display: flex;
        margin: auto;
    }
    #div-sign-up form {
        margin: auto;
    }
    #div-sign-up .input-data input {
        width: 400px;
        height: 40px;
        margin-bottom: 15px;
        font-size: 17px;
    }
    #div-sign-up .input-action {
        display: flex;
        justify-content: space-between;
    }
    #div-sign-up .input-action input {
        width: 170px;
        height: 30px;
        font-size: 15px;
    }
</style>
<div id="div-sign-up">
    <form>
        <div class="input-data">
            <input type="text" placeholder="Nhập Email"><br>
            <input type="password" placeholder="Nhập mật khẩu"><br>
        </div>
        <div class="input-action">
            <input type="submit" value="Đăng kí">
            <input type="reset" value="Nhập lại">
        </div>
    </form>
</div>