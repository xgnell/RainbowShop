<style>
    #counselor {
        display: flex;
    }
    #counselor .counselor {
        width: 33%;
    }
    /* #counselor .second_counselor {
        width: 33%;
        margin: 15px 15px 15px 15px;
    }
    #counselor .third_counselor {
        width: 34%;
        margin: 15px 15px 15px 15px;
    } */
    #counselor .counselor {
        margin: 15px 15px 15px 15px;
        text-align: center;
    }

    #counselor .counselor-avatar {

        border-width: 2px;
        border-color: purple;
        border-style: solid;
        border-radius: 50%;

        width: 300px;
        height: 300px;
        background-image: url(public/img/counselor/counselor_1.png);
        background-size: cover;
        margin: auto;
    }
</style>

<div id="counselor">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="counselor">
            <div class="counselor-avatar">
            </div>
            <br>
            <div>
                Thông tin
            </div>
        </div>
    <?php } ?>
    
    <!-- <div class="second_counselor">
        <div class="counselor_1_size counselor_1">
        </div>
        <div>
            Thông tin
        </div>
    </div>
    
    <div class="third_counselor">
        <div class="counselor_1_size counselor_1">

        </div>
        <div>
            Thông tin
        </div>
    </div> -->
</div>