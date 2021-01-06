<?php
session_start();

// Sau nay se gui ca 1 form nen theo phuong thuc POST
$item_id = $_GET["id"];

$_SESSION["user"]["customer"]["cart"][$item_id] = ["L" => 10];
?>
<script>
    // Sau nay se dung AJAX => thong bao them hang thanh cong se xu ly bang ajax
    // Hoac neu de dang file thuong thi chen them mot thanh phan code de danh dau action => Nhung ko bao mat
    window.history.back();
</script>