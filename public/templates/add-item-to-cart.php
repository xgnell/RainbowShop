<?php
session_start();

// Sau nay se gui ca 1 form nen theo phuong thuc POST
$item_id = $_GET["id"];
$item_size = $_GET["size"];
$item_amount =$_GET["amount"];
// Kiem tra san pham da o trong gio hang chua
// ...

// (Kiem tra trong kho con san pham hay ko)

echo $item_amount;
echo $item_size;
$_SESSION["user"]["customer"]["cart"][$item_id]["size"] = [
    $item_id => $item_amount,
    $item_id => $item_size
    // 1 => rand(10, 50),
    // 2 => rand(10, 50),
    // 3 => rand(10, 50),
    // "XXL" => rand(10, 50)
];
?>
<script>
    // Sau nay se dung AJAX => thong bao them hang thanh cong se xu ly bang ajax
    // Hoac neu de dang file thuong thi chen them mot thanh phan code de danh dau action => Nhung ko bao mat
    // window.history.back();
</script>
