<style>
    .disp-items>div {
        display: flex;
        justify-content: space-between;
        /* margin: 20px 20px 20px 20px;
        background-color: white;
        border-radius: 7px; */
    }

    .panel {
        margin: 30px 10% 30px 10%;
        background-color: white;
        border-radius: 7px;
        box-shadow: 1px 1px 5px #ccc;
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
        background-image: url(/public/img/counselors/tu_van.jpg);
        background-size: cover;
        margin: auto;
    }
</style>

<div class="panel">
    <div>
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
</div>
