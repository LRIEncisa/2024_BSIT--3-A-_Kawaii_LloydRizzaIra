<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];

if ($_SESSION['user_info_user_type'] != 'C') {
    header("location: ../index.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../index.php"); //go back to the landing page of the visitors page.
    die();
}

if (isset($_GET['delete_from_cart'])) {
    $order_id = $_GET['delete_from_cart'];
    $sql_delete_from_cart = "DELETE FROM orders WHERE orders_id = '$order_id' and order_phase = '1' ";
    $sql_execute = mysqli_query($conn, $sql_delete_from_cart);
    if ($sql_execute) {
        header("location: index.php?page=home&msg=cart item removed.");
    }
}

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $status = "";
    if ($msg == 1) {
        $status = "Order Placed Successfully.";
        ?>
        <div class="alert alert-success">
            <?php echo $status; ?>
        </div>
    <?php } else {
        $status = "Error: " . $_GET['msg']; // Assuming the message is directly provided by the backend
        ?>
        <div class="alert alert-danger">
            <?php echo $status; ?>
        </div>
    <?php }
}

?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('https://w.wallhaven.cc/full/gj/wallhaven-gjwg6q.jpg');
    background-size: cover;
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
}

.col-3 {
    border: 2px solid #ddd; /* Add a border with 2px width and light gray color */
    border-radius: 10px; /* Add border radius for rounded corners */
    padding: 8px; /* Add padding inside the border */
    box-shadow: 0 3px 12px rgba(255,133,162,0.25);
    border-color: pink;
    border-width: 4px;
    max-width: 400px;
    margin: 0 auto; /* Center the column horizontally */
    margin-top: 40px;
}


.dis-6 {
    color: blank;
    font-size: 40px; /* Set the font size to 80px */
    font-weight: bold;
    margin-top: 3px;
    margin-bottom: 10px;
}

/* Styling for the main container */

/* Header styles */
.display-3 {
    color: #f1f1f1;
    font-size: 50px;
    font-weight: bold;
    margin-left: 20px;
    margin-top: 70px;
    margin-bottom: 10px;
}

.container-fluid {
    padding-top: 20px;
    margin: auto;
    width: 50%;
    margin-top: 100px;
}


/* Table styling */
.table {
    background-color: #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
    margin-top: 8px; /* Add margin-top of 8px */
}

.table th, .table td {
    padding: 12px;
    border-bottom: 2px solid #f1f1f1;
    text-align: center;
}

.table tr:last-child td {
    border-bottom: none;
}


/* Button styles */
.btn {
    border: none;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    border-radius: 20px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    cursor: pointer;
}

.btn-primary, .btn-danger, .btn-warning {
    /* Applying new color schemes */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-primary {
    background-color: #ff85a2;
}

.btn-primary:hover {
    background-color: #ff6384;
    transform: scale(1.05);
}

.btn-danger {
    background-color: #ff7272;
}

.btn-danger:hover {
    background-color: #fa5252;
    transform: scale(1.05);
}

.btn-warning {
    background-color: #ffd43b;
}

.btn-warning:hover {
    background-color: #fcc419;
    transform: scale(1.05);
}

.btn-link {
    background-color: transparent;
    color: #ff85a2;
    padding-left: 0;
    transition: color 0.3s ease;
}

.btn-link:hover {
    color: #ff6384;
    background-color: transparent;
}

/* Input styles */
.input-group {
    margin-top: 10px;
    margin-bottom: 10px;
}

input[type="number"], input[type="text"], input[type="submit"] {
    border: 2px solid #ddd;
    border-radius: 10px;
    padding: 8px;
    transition: border-color 0.3s ease;
}

input[type="number"]:focus, input[type="text"]:focus, input[type="submit"]:focus {
    border-color: #ff85a2;
    outline: none;
}

.btn.btn-link.logout {
    background-color: #ff85a2;      /* Pink background color */
    color: white;                   /* White text for contrast */
    padding: 8px 16px;              /* Padding for a button-like shape */
    border: none;                   /* No border for a clean, modern look */
    border-radius: 20px;            /* Rounded corners for a soft, friendly appearance */
    cursor: pointer;                /* Cursor like a button */
    font-size: 16px;                /* Font size to match other buttons */
    font-family: inherit;           /* Inherits the font from the parent or defaults */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions for interactive effects */
    text-decoration: none;          /* No underline, to differentiate from links */
}

.btn.btn-link.logout:hover, .btn.btn-link.logout:focus {
    background-color: #ff6384;      /* Lighter pink on hover for visual feedback */
    transform: scale(1.05);         /* Slight enlargement on hover/focus for tactile feedback */
    color: white;                   /* Maintain text color for readability */
    outline: none;                  /* Removes the outline to keep a clean look on focus */
}

/* Miscellaneous */
hr {
    border-top: 1px solid #eee;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .display-3, .display-6 {
        font-size: 16px;
    }

    .btn, input[type="number"], input[type="submit"] {
        width: 100%;
        margin-top: 5px;
    }

    .input-group {
        flex-direction: column;
    }
}

</style>
<html>
<head>
    <meta charset="UTF-8">
    <title>Client's Page</title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/checkout_summary.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<!-- Cart Section -->
<div class="col-3">
    <?php
    $sql_check_cart_empty = "SELECT COUNT(*) AS cart_count FROM orders WHERE user_id='$s_user_id' AND order_phase='1'";
    $cart_count_result = mysqli_query($conn, $sql_check_cart_empty);
    $cart_count_row = mysqli_fetch_assoc($cart_count_result);
    $cart_count = $cart_count_row['cart_count'];

    if ($cart_count > 0) {
        if (isset($_GET['checkout'])) { ?>

            <!-- Checkout Summary -->
            <div class="cardp-1">
                <h3 class="card-title">Checkout Summary</h3>
                <div class="card-body">
                    <?php
                    // Generate order reference number
                    $order_number = gen_order_ref_number(8);

                    $sql_checkout = "SELECT i.item_name
                                    , i.item_price
                                    , i.item_desc
                                    , i.item_image
                                    , o.item_qty
                                    , o.date_added
                                    , o.orders_id
                                FROM `orders` as o
                                JOIN `items` as i
                                ON (o.items_id = i.items_id)
                                WHERE o.user_id='$s_user_id' 
                                AND o.order_phase='1'";
                    $result_chkout = mysqli_query($conn, $sql_checkout);
                    ?>

                    <div class="alert alert-light">
                        Order Reference Number: <?php echo $order_number; ?><br>
                        Receiver: <?php echo $_SESSION['user_info_fullname']; ?><br>
                        Address: <?php echo $_SESSION['user_info_address']; ?>
                    </div>

                    <ul class="list-group">
                        <?php
                        // Initialize total amount
                        $total_amt = 0.00;

                        while ($co = mysqli_fetch_assoc($result_chkout)) {
                            // Add up every loop of the result.
                            $total_amt = $total_amt + ($co['item_price'] * $co['item_qty']);
                            ?>
                            <li class="list-group-item"><?php echo $co['item_name'] . " - Php " . number_format($co['item_price'], 2) . " x " . $co['item_qty'] . " pcs"; ?></li>
                        <?php } ?>
                        <li class="list-group-item">
                            <b>Total Amount to Pay: <?php echo "Php " . number_format($total_amt, 2); ?></b>
                        </li>
                    </ul>

                    <!-- Checkout Form -->
                    <form action="process_place_order.php" method="post">
                        <div class="mt-3">
                            <input type="text" hidden name="f_total_amt_to_pay" value="<?php echo $total_amt; ?>">
                            <label for="">Alternate Receiver Name:</label>
                            <input type="text" class="form-control mb-3" placeholder="This is Optional" name="f_alt_receiver">
                            <label for="">Ship to this Address:</label>
                            <input type="text" class="form-control mb-3" placeholder="This is Optional" name="f_alt_address">
                            <label for="" class="form-label">Payment Method:</label>
                            <select name="f_payment_method" id="" class="form-select mb-3">
                                <?php
                                $sql_get_payment_method = "SELECT * FROM `payment_method`";
                                $payment_method_result = mysqli_query($conn, $sql_get_payment_method);

                                while ($pm = mysqli_fetch_assoc($payment_method_result)) { ?>
                                    <option value="<?php echo $pm['payment_method_id']; ?>"><?php echo $pm['payment_method_desc']; ?></option>
                                <?php } ?>
                            </select>
                            <label for="">Shipping Options:</label>
                            <select name="f_ship_option" class="form-select mb-2" id="">
                                <?php
                                $sql_get_shipping_method = "SELECT * FROM `shippers`";
                                $shipping_method_result = mysqli_query($conn, $sql_get_shipping_method);

                                while ($pm = mysqli_fetch_assoc($shipping_method_result)) { ?>
                                    <option value="<?php echo $pm['shipper_id']; ?>"><?php echo $pm['shipping_company']; ?></option>
                                <?php } ?>
                            </select>
                            <input readonly hidden type="text" name="f_order_ref_number" value="<?php echo $order_number; ?>">
                            <input type="submit" value="Place Order" class="btn btn-warning">
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>

            <!-- Cart Display -->
            <h6 class = "dis-6">Cart</h6>
            <?php
            $sql_get_cart_items = "SELECT i.item_name
                                        , i.item_price
                                        , i.item_desc
                                        , i.item_image
                                        , o.item_qty
                                        , o.date_added
                                        , o.orders_id
                                    FROM `orders` as o
                                    JOIN `items` as i
                                    ON (o.items_id = i.items_id)
                                    WHERE o.user_id='$s_user_id' 
                                    AND o.order_phase='1' ";

            $cart_results = mysqli_query($conn, $sql_get_cart_items);
            echo "<table class='table'>";
            while ($cart = mysqli_fetch_assoc($cart_results)) { ?>
                <tr>
                    <td> <img src="../uploads/<?php echo htmlspecialchars($cart['item_image']); ?>" width="40px" alt="" class="img-fluid "></td>
                    <td> <?php echo htmlspecialchars($cart['item_name']); ?> </td>
                    <td> <?php echo htmlspecialchars($cart['item_qty']) . " pcs"; ?> </td>
                    <td> <?php echo "Php " . number_format($cart['item_price'] * $cart['item_qty'], 2); ?> </td>
                    <td> <a href="?delete_from_cart=<?php echo $cart['orders_id']; ?>" class="btn btn-danger btn-sm">x</a> </td>
                </tr>
            <?php }
            echo "</table>";
            ?>
            <hr>
            <a href="?page=home&checkout" class="btn btn-warning">Checkout</a>

        <?php } 
    } else {
        // Cart is empty message
        ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php } ?>

</div>
</body>
</html>