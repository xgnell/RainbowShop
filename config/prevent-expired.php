<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/notification/display-error-page.php");
if (basename($_SERVER['PHP_SELF']) == "prevent-expired.php") {
    display_error_page(404, "Không tìm thấy trang");
    exit();
}

// Chặn Document Expired
ini_set('session.cache_limiter','public');
session_cache_limiter(false);