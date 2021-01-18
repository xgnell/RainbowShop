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
            </tr>
        <!-- </table>
    </div> -->
<?php } ?>
