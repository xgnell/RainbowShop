<?php
// Check for signed in
if (customer_signed_in()) {
    // Add item to customer cart
} else {
    // Require sign in
    sign_in_action();
}