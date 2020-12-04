<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signe in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);
?>
<!-- Send notification to client -->
<div id="notification">Success</div>
<script>
    setTimeout(function() {
        window.location.href = "/manager/customers/customers_manager.php";
    }, 1000);
</script>
