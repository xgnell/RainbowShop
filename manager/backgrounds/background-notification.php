<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signe in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);
?>
<!-- Send notification to client -->
<div id="notification">Thành công</div>
<script>
    setTimeout(function() {
        window.location.href = "/manager/backgrounds/background-manager.php";
    }, 1000);
</script>
