<?php
// process_cancel_order.php

// Include the database connection
include_once "../db.php";

// Check if the cancel_order parameter is set in the URL
if(isset($_GET['cancel_order'])) {
    // Sanitize the input to prevent SQL injection
    $order_ref_number = mysqli_real_escape_string($conn, $_GET['cancel_order']);
    
    // Update the order phase to 'Cancelled' in the database
    $sql_cancel_order = "UPDATE `orders` SET `order_phase`='0' WHERE `order_ref_number`='$order_ref_number'";
    $result = mysqli_query($conn, $sql_cancel_order);
    
    // Check if the query was successful
    if($result) {
        // Redirect back to the manage orders page with a success message
        header("Location: index.php?manageorder&orderphase=0&cancel_status=success");
        exit();
    } else {
        // Redirect back to the manage orders page with an error message
        header("Location: index.php?manageorder&orderphase=0&cancel_status=error");
        exit();
    }
} else {
    // If the cancel_order parameter is not set, redirect to the manage orders page
    header("Location: index.php?manageorder");
    exit();
}
?>
