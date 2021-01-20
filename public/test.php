<!DOCTYPE html>
<html>

<head>
    <style>
        .item1 {
            grid-area: header;
        }

        .item2 {
            grid-area: menu;
        }

        .item3 {
            grid-area: main;
        }

        .item4 {
            grid-area: right;
        }

        .item5 {
            grid-area: footer;
        }

        .grid-container {
            display: grid;
            grid-template-areas:
                'header header header header header header'
                'menu main main main right right'
                'menu footer footer footer footer footer';
            grid-gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-container > .test {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
        }

        .item-on-top {
            grid-area: item-on-top;
        }
        .item-on-bottom {
            grid-area: item-on-bottom;
        }
        .item-on-left {
            grid-area: item-on-left;
        }

        .grid-table-item {
            display: grid;
            grid-template-areas: 
                'item-on-left item-on-top item-on-top'
                'item-on-left item-on-bottom item-on-bottom';
            grid-gap: 100px;
            background-color: red;
            padding: 20px;
        }

    </style>
</head>

<body>

    <h1>Grid Layout</h1>

    <p>This grid layout contains six columns and three rows:</p>

    <div class="grid-container">
        <div class="item1 test">Header</div>
        <div class="item2 test">Menu</div>
        <div class="item3 test">Main</div>
        <div class="item4 test">Right</div>
        <div class="item5 test">Footer</div>
    </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <div class="grid-table-item">
        <div>San pham 1</div>
        <div>San pham 2</div>
        <div>San pham 3</div>
        <div>San pham 4</div>
        <div>San pham 5</div>
    </div>
</body>

</html>