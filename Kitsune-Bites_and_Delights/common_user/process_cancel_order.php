<?php
if(isset($_GET['cancel_order'])){
    include_once "../db.php";
    $orderrefnum = $_GET['cancel_order'];
    
     $sql_update_order="UPDATE `orders`
                                SET `order_phase` = '0'
                               WHERE `order_ref_number` = '$orderrefnum';
                               ";
         $try = mysqli_query($conn, $sql_update_order);
     
    if($try){
          header("location: index.php?page=myorder");   
    }
}