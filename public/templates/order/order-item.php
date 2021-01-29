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
            SELECT *
            FROM bill_states
            WHERE id = {$bill["id_state"]};
        ");
        $bill_state = mysqli_fetch_array($bill_state);
    ?>

    <tr>
        <td>
            <span><?= $bill["receiver"] ?></span>
        </td>

        <td>
            <span><?= $bill["address"] ?></span>
        </td>

        <td>
            <span><?= $bill["phone"] ?></span>
        </td>

        <td>
            <span><?= $bill["purchase_time"] ?></span>
        </td>


        <td style="text-align: right;">
            <?php
                switch ($bill_state['id']) {
                    case 1:
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="<?= $bill_state['color'] ?>" width="36px" height="36px"><g><rect fill="none" height="24" width="24"/></g><g><path d="M18,22l-0.01-6L14,12l3.99-4.01L18,2H6v6l4,4l-4,3.99V22H18z M8,7.5V4h8v3.5l-4,4L8,7.5z"/></g></svg>
                        <?php
                        break;
                    case 2:
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        <?php
                        break;
                    case 3:
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>
                        <?php
                        break;
                    default:
                        break;
                }
            ?>
        </td>
        <td style="text-align: left;">
            <!-- Lam noi bat mau sac cua trang thai -->
            <span style="color: <?= $bill_state["color"]; ?>"><?= $bill_state["state"] ?></span>
        </td>


        <td>
            <a href="/public/display-orders-details.php?id=<?= $bill_id ?>">
                <svg style="position: relative; top: 3px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z"/></svg>
            </a>
        </td>

        <!-- <td style="cursor: pointer;" onclick="show_delete_info()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
        </td> -->
    </tr>

<?php } ?>

<!-- <script>
    function show_delete_info() {
        if (delete_order.style.display === "block") {
            delete_order.style.display = "none";
        } else {
            delete_order.style.display = "block";
        }
    }
</script> -->