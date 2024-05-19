<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];
if ($_SESSION['user_info_user_type'] != 'C') {
    header("location: ../index.php");
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../index.php");
    exit;
}
if (isset($_GET['delete_from_cart'])) {
    $order_id = $_GET['delete_from_cart'];
    $sql_delete_from_cart = "DELETE FROM orders WHERE orders_id = '$order_id'";
    $sql_execute = mysqli_query($conn, $sql_delete_from_cart);
    if ($sql_execute) {
        header("location: index.php?msg=cart_item_removed");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Your Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<style>
    /* Overall body styling */
/* Overall body styling */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    padding-top: 20px;
}

/* Styling for the main container */
.container-fluid {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

/* Header styles */
.display-3 {
    color: #5c5c8a;
    font-size: 24px;
    font-weight: bold;
}

.display-6 {
    color: #5c5c8a;
    font-size: 18px;
    font-weight: bold;
}

/* Table styling */
.table {
    background-color: #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
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

.item-container {
    display: flex;         /* Enables flexbox layout */
    flex-wrap: wrap;       /* Allows items to wrap onto the next line */
    gap: 20px;             /* Space between items */
    justify-content: flex-start; /* Align items to the start of the container */
}

.item {
    flex: 1 1 200px;       /* Each item can grow and shrink but base at 200px */
    box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Optional: Adds shadow for better visibility */
    margin-bottom: 20px;   /* Space at the bottom of each item */
    border-radius: 8px;    /* Optional: Rounds corners of the item boxes */
    overflow: hidden;      /* Ensures no content spills out */
    background: white;     /* Background color for the item */
}

.item-info {
    padding: 15px; /* Adds padding inside the item box */
    text-align: center; /* Centers the text inside the item-info div */
}

.item-name, .item-desc, .item-price {
    margin: 10px 0; /* Adds vertical spacing between elements */
}

.item-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}



</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <h3 class="display-3">Welcome, <?php echo $_SESSION['user_info_fullname']; ?></h3>
                <button type="button" class="btn btn-link logout" onclick="location.href='?logout'">Logout</button>
                <hr>
                
                <div class="col-8">
                    <div class="item-container">
                        <?php
                        $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' ORDER BY items_id DESC";
                        $get_result = mysqli_query($conn, $sql_get_items);
                        while ($row = mysqli_fetch_assoc($get_result)) { ?>
                            <div class="item">
                                <img src="../uploads/<?php echo htmlspecialchars($row['item_image']); ?>" alt="" class="item-image">
                                <div class="item-info">
                                    <h4 class="item-name"><?php echo htmlspecialchars($row['item_name']); ?></h4>
                                    <p class="item-desc"><?php echo htmlspecialchars($row['item_desc']); ?></p>
                                    <p class="item-price"><?php echo "Php " . number_format($row['item_price'], 2); ?></p>
                                    <form action="process_add_to_cart.php" method="get" class="form-inline">
                                        <input type="hidden" name="item_id" value="<?php echo $row['items_id']; ?>">
                                        <input type="number" class="form-control mb-2 mr-sm-2" name="cart_qty" placeholder="Quantity" required>
                                        <button type="submit" class="btn btn-primary mb-2">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


               


                <div class="col-4">
    <h6 class="display-6">Cart</h6>
    <?php if (isset($_GET['view_cart'])): ?>
        <button class="btn btn-primary" onclick="location.href='index.php'">Close Cart</button>
    <?php else: ?>
        <button class="btn btn-primary" onclick="location.href='?view_cart=1'">View Cart</button>
    <?php endif; ?>

    <?php
    if (isset($_GET['view_cart'])) {
        $sql_get_cart_items = "SELECT i.item_name, i.item_price, i.item_desc, i.item_image, o.item_qty, o.date_added, o.orders_id
                                FROM `orders` AS o
                                JOIN `items` AS i ON o.item_id = i.items_id
                                WHERE o.user_id='$s_user_id' AND o.order_phase='1'";
        $cart_results = mysqli_query($conn, $sql_get_cart_items);
        if (mysqli_num_rows($cart_results) > 0) {
            echo "<table class='table'>";
            $total_price = 0;
            while ($cart = mysqli_fetch_assoc($cart_results)) {
                $total_price += $cart['item_price'] * $cart['item_qty'];
                ?>
                <tr>
                    <td><img src="../uploads/<?php echo htmlspecialchars($cart['item_image']); ?>" alt="Item image" style="width: 50px; height: auto;"></td>
                    <td><?php echo htmlspecialchars($cart['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($cart['item_qty']) . " pcs"; ?></td>
                    <td><?php echo "Php " . number_format($cart['item_price'] * $cart['item_qty'], 2); ?></td>
                    <td><a href="?delete_from_cart=<?php echo $cart['orders_id']; ?>&view_cart=1" class="btn btn-danger btn-sm">Remove</a></td>
                </tr>
                <?php
            }
            echo "</table>";
            echo "<p><strong>Total: Php " . number_format($total_price, 2) . "</strong></p>";
            ?>
            <hr>
            <!-- Button to initiate checkout -->
            <a href="?view_cart=1&checkout=1" class="btn btn-warning">Proceed to Checkout</a>
            <?php
        } else {
            echo "<p>Your cart is empty.</p>";
        }
    }

    // Checkout form
    if (isset($_GET['checkout'])) {
        ?>
        <h4>Checkout</h4>
        <form method="post" action="place_order.php">
            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="payment">Payment Method:</label>
                <select class="form-control" id="payment" name="payment">
                    <option>Credit Card</option>
                    <option>PayPal</option>
                    <option>Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
        <?php
    }
    ?>
</div>



        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>