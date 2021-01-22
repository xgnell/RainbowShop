<!-- <style>
    .order-item .table-info {
        border: 2px white solid;
        border-collapse: collapse;
        text-align: center;
        vertical-align: middle;
        width: 100%;
    }
    .order-item .table-info tr {
        border: 2px white solid;
    }
    .order-item .table-info tr {
        border: 2px white solid;
    }
    .order-item .table-info tr td {
        border: 2px white solid;
        background-color: #f7f7f7;
        padding: 10px 10px 10px 10px;
    }
</style> -->
<?php function spawn_order_item($bill_id) { ?>
    <?php
        $bill = sql_query("
            SELECT *
            FROM bills
            WHERE id = '$bill_id';
        ");
        $bill = mysqli_fetch_array($bill);

        $bill_state = sql_query("
            SELECT state
            FROM bill_states
            WHERE id = {$bill["id_state"]};
        ");
        $bill_state = mysqli_fetch_array($bill_state)["state"];
    ?>

    <!-- <div class="order-item">
        <table class="table-info"> -->
            <tr>
                <!-- style="width: 200px; min-width: 200px" -->
                <td>
                    <span><?= $bill["receiver"] ?></span>
                </td>

                <!-- style="width: 270px; min-width: 270px;" -->
                <td>
                    <span><?= $bill["address"] ?></span>
                </td>

                <!-- style="width: 120px; min-width: 120px;" -->
                <td>
                    <span><?= $bill["phone"] ?></span>
                </td>

                <!-- style="width: 200px; min-width: 200px;" -->
                <td>
                    <span><?= $bill["purchase_time"] ?></span>
                </td>

                <!-- style="width: 170px; min-width: 170px;" -->
                <td>
                    <!-- Lam noi bat mau sac cua trang thai -->
                    <span><?= $bill_state ?></span>
                </td>

                <td>
                    <a href="/public/display-orders-details.php?id=<?= $bill_id ?>">Chi tiết</a>
                </td>

                <td style="cursor: pointer;" onclick="show_delete_info()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                </td>
            </tr>
        <!-- </table>
    </div> -->
<?php } ?>

<script>
    function show_delete_info() {
        if (delete_order.style.display === "block") {
            delete_order.style.display = "none";
        } else {
            delete_order.style.display = "block";
        }
    }
</script>