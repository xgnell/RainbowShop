<?php
session_start();

// Sau nay se gui ca 1 form nen theo phuong thuc POST
$item_id = $_GET["id"];

// Kiem tra san pham da o trong gio hang chua
// ...

// (Kiem tra trong kho con san pham hay ko)

$_SESSION["user"]["customer"]["cart"][$item_id] = [
    1 => rand(10, 50),
    2 => rand(10, 50),
    4 => rand(10, 50),
    // "XXL" => rand(10, 50)
];
?>
<script>
    // Sau nay se dung AJAX => thong bao them hang thanh cong se xu ly bang ajax
    // Hoac neu de dang file thuong thi chen them mot thanh phan code de danh dau action => Nhung ko bao mat
    window.history.back();
</script>
