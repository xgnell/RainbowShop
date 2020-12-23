<?php
session_start();
session_destroy();
header("location:/manager/main/sign-in.php");
