<style>
	#account-options {
		visibility: hidden;
		z-index: 10;
		position: absolute;
		top: 75px;
		right: 70px;
		width: 220px;
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
		left: 75px;
		z-index: -1;
		transform: rotate(-45deg);
	}

	/*Display customer name*/
	#account-options .hello {
		display: inline-block;
		width: 100%;
		/* border: 2px black solid; */
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
	#account-options ul a {
		color: black;
	}
</style>

<div id="account-options"
	onmouseleave="document.getElementById('account-options').style.visibility = 'hidden'">
	<span class="hello"><?= $_SESSION["user"]["customer"]["name"] ?></span><br>
	<div style="display: flex; justify-content: center;">
		<hr width="170px" style="color: #dedede; margin: 10px 0 10px 0;">
	</div>
	<ul>
		<a href="/public/templates/account/update-account.php?id=<?php echo $_SESSION["user"]["customer"]["id"] ?>">
			<li>Chỉnh sửa thông tin</li>
		</a>

		<a href="/public/display-orders.php">
			<li>Lịch sử mua hàng</li>
		</a>

		<a href="/public/templates/account/sign-out-process.php">
			<li>Đăng xuất</li>
		</a>
	</ul>
</div>