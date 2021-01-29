<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/manager/templates/notification-page.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/notification/display-error-page.php");
	if (basename($_SERVER['PHP_SELF']) == "account-options.php") {
    display_error_page(404, "Không tìm thấy trang");
    exit();
}
?>
<style>
	#account-options {
		visibility: hidden;
		z-index: 10;
		position: absolute;
		top: 75px;
		right: 70px;
		width: 200px;
		height: 300px;
		background-color: white;
		padding: 15px 10px 15px 10px;
		border-radius: 5px;
        box-shadow: 0px 5px 10px #2e2e2e;
        text-align: center;
	}
	
	#account-options::before {
		content: "";
		width: 20px;
		height: 20px;
		background-color: white;
		position: absolute;
		top: -10px;
		left: 55px;
		z-index: -1;
		transform: rotate(-45deg);
	}

	/*Display customer name*/
	#account-options .hello {
		display: inline-block;
		width: 100%;
		border: 2px black solid;
		border-radius: 3px;
		text-align: center;
		font-size: 20px;
		font-weight: bold;
		padding: 5px 0 5px 0;
	}

	/*Options menu*/
	#account-options ul {
		text-align: left;
	}
	#account-options ul li {
		cursor: pointer;
		margin: 5px 0 5px 0;
		padding: 5px 10px 5px 10px;
		border-radius: 3px;
	}
	#account-options ul li:hover {
		background-color: rgb(208, 209, 214);
	}
	#account-options ul li a {
		color: black;
	}
</style>

<div id="account-options"
	onmouseleave="document.getElementById('account-options').style.visibility = 'hidden'">
	<span class="hello"><?= $_SESSION["user"]["customer"]["name"] ?></span><br>
	<ul>
		<li><a href="/public/templates/account/update-account.php?id=<?php echo $_SESSION["user"]["customer"]["id"] ?>">Chỉnh sửa thông tin</a></li>
		<li><a href="/public/display-orders.php">Lịch sử mua hàng</a></li>
		<!-- <li><a>Cài đặt</a></li> -->
		<li><a href="/public/templates/account/sign-out-process.php">Đăng xuất</a></li>
	</ul>
</div>