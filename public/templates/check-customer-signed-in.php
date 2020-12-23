<?php
session_start();
function check_customer_signed_in() {
    if (!customer_signed_in()) {
        ?>
            <style>
                #not-signed-in-popup {
                    position: fixed;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    margin-top: 30px;
                }
                #not-signed-in-popup > div {
                    width: 30%;
                    height: 30%;
                    background-color: white;
                    border: 1px black solid;
                }
            </style>
            <div id="not-signed-in-popup">
                <div>
                    <button onclick="document.getElementById('not-signed-in-popup').remove();">X</button>
                    <h1>You have to sign in first</h1>
                </div>
            </div>
        <?php
        die();
    }
}
function customer_signed_in() {
    if (isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == "customer") {
        return true;
    }
    return false;
}
