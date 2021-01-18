<?php
    session_start();

    $item_id = $_POST["id"];
    $item_size_id = $_POST["size_id"];
    $item_amount = $_POST["amount"];
    // Sau sửa lại redirect tối ưu hơn
    $redirect = $_POST["redirect"];

    // Check if item in cart
    if (array_key_exists($item_size_id, $_SESSION["user"]["customer"]["cart"][$item_id])) {
        // Update
        $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] += $item_amount;
    } else {
        // Add new
        $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] = $item_amount;
    }

    // (Kiem tra trong kho con san pham hay ko)
    // ...

    if ($redirect == 0) {
        header("location:/public/home.php");
    } else {
        header("location:/public/display-cart.php");
    }
?>
<!-- <script>
    // Sau nay se dung AJAX => thong bao them hang thanh cong se xu ly bang ajax
    // Hoac neu de dang file thuong thi chen them mot thanh phan code de danh dau action => Nhung ko bao mat
    // window.history.back();
</script> -->