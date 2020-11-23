<?php
define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB_NAME", "bigprojectone");

function sql_query($query_msg) {
    $connect = mysqli_connect(
        SERVER_NAME,
        USERNAME,
        PASSWORD,
        DB_NAME
    );
    if (!$connect) {
        trigger_error(mysqli_connect_error(), E_USER_ERROR);
    }
    mysqli_set_charset($connect, "utf8");

    $result = mysqli_query($connect, $query_msg) or trigger_error(mysqli_error($connect), E_USER_ERROR);

    mysqli_close($connect);

    return $result;
}