<style>
    #background_all {
        margin: 20px 0px 20px 0px;
        height: 700px;
        background-size: cover;
        position: relative;    
        /* background-color: rgba(0,0,0,0.5); */
        background-image: url("/public/img/background/bg2.png");
        z-index: 1;
    }
    .content_bar {
        width: 100%;
        height: 90%;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    .content_bar .content {
        width: 75%;
        height: 80%;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    .content_bar .content .search_bar_in_background {
        background-color: #ffffff;
        border-radius: 100px;
        height: 60px;
        width: 500px;
        position: relative; top: 50%; left: 90px;
    }
    .content_bar .content .search_bar_in_background input {
        border-style: none;
        outline: none;
        height: 100%;
        width: 400px;
        font-size: 16px;
    }
    .content_bar .content .search_bar_in_background .icon {
        margin: 0 0 0 0;
        margin-left: 5px;
        margin-right: 5px;
        float: left;
        opacity: 0.5;
    }
    .content_bar .content .search_bar_in_background .icon:hover {
        opacity: 1;
    }
</style>
<div id="background_all">
    <div class="content_bar">
        <div class="content">
            <div class="search_bar_in_background">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="60" viewBox="0 0 24 24" width="40"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                </span>
                <span style="float: left;">
                    <input type="text" placeholder="Press Enter to search">
                </span>
                <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="60" viewBox="0 0 24 24" width="40"><rect fill="none" height="24" width="24"/><path d="M15,5l-1.41,1.41L18.17,11H2V13h16.17l-4.59,4.59L15,19l7-7L15,5z"/></svg>
                </span>
            </div>
        </div>
    </div>
</div>