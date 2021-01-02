<style>
    #sign-in-form {
        display: flex;
        justify-content: center;
        position: fixed;
        width: 100vw;
        height: 100vh;
        z-index: 999;
    }
    #sign-in-form > div {
        margin-top: 200px;
        width: 35%;
        height: 35%;
        text-align: center;
        background-color: white;
        border: 1px black solid;
    }
    #sign-in-form[hidden] {
        display: none;
    }
</style>
<div id="sign-in-form" hidden>
    <div>
        <button onclick="document.getElementById('sign-in-form').hidden = true;">X</button>
        <h3>Sign in your account</h3>
        <form action="/public/templates/sign-in-process.php" method="POST">
            Email: <input type="text" name="email"><br>
            Password: <input type="password" name="passwd"><br>
            <input type="submit" value="Sign in"><br>
            <a href="#">Sign up</a>
            <a href="#">Forget your account ?</a>
        </form>
    </div>
</div>
<script>
    const sign_in_form = document.getElementById('sign-in-form');
    window.onclick = function(event) {
        if (event.target == sign_in_form) {
            sign_in_form.hidden = true;
        }
    }
</script>