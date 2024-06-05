<?php
include "../db.php";
session_start();
if(isset($_GET['item_id'])){
    $user_id = $_SESSION['user_info_id'];
    $item_id = $_GET['item_id'];
    $item_qty = $_GET['cart_qty'];
    
    // Ensure the variable name is correct (changed $items_id to $item_id)
    $sql_add_to_cart = "INSERT INTO `orders`
           (`user_id`, `items_id`, `item_qty`)
           VALUES
           ('$user_id','$item_id','$item_qty')";
    $execute_cart = mysqli_query($conn, $sql_add_to_cart);
    
    if($execute_cart){
        header("Location: index.php?page=home");
        exit(); 
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>
