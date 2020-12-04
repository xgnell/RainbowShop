<?php
session_start();
session_destroy();
header("location:/manager/main/sign_in.php");
