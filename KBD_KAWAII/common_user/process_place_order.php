<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    


<style> 
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('https://w.wallhaven.cc/full/gj/wallhaven-gjwg6q.jpg');
    background-size: cover;
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
}

.card-p2 {
    border: 4px solid pink; /* Add a border with 4px width and pink color */
    border-radius: 10px; /* Add border radius for rounded corners */
    padding: 8px; /* Add padding inside the border */
    box-shadow: 0 3px 12px rgba(255,133,162,0.25);
    margin-top: 12%; /* Add margin-top */
    max-width: 500px; /* Set max-width */
    margin-left: auto; /* Center horizontally */
    margin-right: auto; /* Center horizontally */
    font-size: 23px;
    background-color: #fff0f6;
}

.disply-3 {
    font-size: 30px; /* Set the font size to 80px */
    font-weight: bold;
    margin-top: 3px;
    margin-bottom: 10px;
}

.form-control {
    border-radius: 15px;
    background-color: #fff0f6;
}

.form-control:focus {
    background-color: #fff0f6;
    border-color: #fff0f6
    
}

.btn-primary{
    border: none;
    color: rgb(255, 255, 255);
    background-color: rgb(240, 128, 128);
    padding: 10px 15px;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    border-radius: 20px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    cursor: pointer;
    font-size: 20px;
}

.btn-primary:hover{
    background-color: #ff85a2;
}

</style>
</head>

<body>
    
<?php
include_once "../db.php";
session_start();


if(isset($_POST['f_payment_method'])){
    $payment_method = $_POST['f_payment_method'];
    $order_ref_number = $_POST['f_order_ref_number'];
    $user_id = $_SESSION['user_info_id'];
    $alt_receiver = $_POST['f_alt_receiver'];
    $alt_address = $_POST['f_alt_address'];
    $shipper_id = $_POST['f_ship_option'];
    $total_amt_to_pay = $_POST['f_total_amt_to_pay'];
    
    if( $payment_method == "1" ){ 
    //check if payment method is gcash
    ?>
      
      <div class="card-p2">
       <h3 class="disply-3">Input Gcash Payment Details</h3>
        <form action="process_gcash_payment.php" method="POST">
           
           
           Total Amount to Pay: <b> <?php echo "Php " . number_format($total_amt_to_pay,2); ?> </b> <br>
           Please pay EXACT AMOUNT to this Gcash Account Number: 09958691376
           <br>Account Name: KitsuneBites&Delights
           <hr>
           <input type="text" hidden name="f_total_amt_to_pay" value="<?php echo $total_amt_to_pay; ?>" />
           <input type="text" hidden name="f_payment_method" value="<?php echo $payment_method; ?>" />
           <input type="text" hidden name="f_order_ref_number" value="<?php echo $order_ref_number; ?>" />
           <input type="text" hidden name="f_alt_receiver" value="<?php echo $alt_receiver; ?>" />
           <input type="text" hidden name="f_alt_address" value="<?php echo $alt_address; ?>" />
           <input type="text" hidden name="f_shipper_id" value="<?php echo $shipper_id; ?>" />
           
            <div class="mb-3">
                <label for="" class="form-label">Gcash Reference Number</label>
                <input type="text" class="form-control" name="f_gcash_ref_num">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gcash Account Sender Name</label>
                <input type="text" class="form-control" name="f_gcash_acc_name">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gcash Account Number</label>
                <input type="text" class="form-control" name="f_gcash_acc_num">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gcash Amount Sent</label>
                <input type="text" class="form-control" name="f_gcash_amt_sent">
            </div>
            <input type="submit" value="Save" class="btn-primary">
        </form>
        </div>
    
    <?php 
    die();                            
    }
    
        
    $sql_update_order = "UPDATE `orders`
                            SET `order_phase` = 2
                              , `payment_method` = '$payment_method'
                              , `order_ref_number` = '$order_ref_number'
                              , `alternate_receiver` = '$alt_receiver'
                              , `alternate_address` = '$alt_address'
                              , `shipper_id` = '$shipper_id'
                          WHERE `user_id` = '$user_id' 
                            AND `order_phase` = '1'
                          ";
    $execute_update_order = mysqli_query($conn, $sql_update_order);
    
    if($execute_update_order == 1){
        header("location: index.php?page=home&msg=1");
    }
    else{
        header("location: index.php?page=home&msg=2");
    }

}
?>
<script src="../js/bootstrap.js"></script>
</body>
</html>