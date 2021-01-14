<style>
    .panel {
        margin-top: 1000px;
        margin: 30px 10% 30px 10%;
        background-color: white;
        border-radius: 7px;
        box-shadow: 1px 1px 5px #ccc;
        height: 500px;
        position: relative;
        top: -150px;
        z-index: 1;
    }
    .disp-new-items {
        height: 100%;
    }
    /*                Custom cho phan title o tren              */
    .panel .title {
        color: #cfcfcf;
        height: 10%;
        width: 100%;
        text-align: center;
    }

    .panel .title .hover:hover {
        color: black;
        border-bottom: 4px #363e7e solid;
    }

    .panel .title .title-item {
        color: #cfcfcf;
        font-size: 24px;
        float: left;
        height: 100%;
        margin-left: 20px;
        margin-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    /*                    Custom cho phan day san pham hot o duoi                   */
    .panel .items {
        height: 90%;
    }

    .panel .items .content-items {
        height: 95%;
        width: 100%;
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: center;
    }
    .panel .items .content-items .item-show {
        height: 95%;
    }

</style>

<!-- phan nay la noi dung cua phan title -->
<div class="panel">
    <div class="title">
        <a href="#">
            <span class="title-item hover">
                Sản phẩm được yêu thích nhất
            </span>
        </a>
        <a href="#">
            <span class="title-item hover">
                Sản phẩm mới nhất
            </span>
        </a>
    </div>

    <!-- phan nay la noi dung cua phan day hang len -->
    <div class="items">
        <div class="content-items">
            <div class="item-show">
                <?php
                    $item_data = sql_query("
                        SELECT id
                        FROM items
                        LIMIT 4;
                    ");
                ?>
                <div class="panel">
                    <div class="disp-new-items">
                        <?php
                            foreach ($item_data as $item) {
                                spawn_item($item["id"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>