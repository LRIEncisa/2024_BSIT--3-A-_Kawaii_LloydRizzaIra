<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];

if ($_SESSION['user_info_user_type'] != 'C') {
    header("location: ../index.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/item_container.css">
    <link rel="stylesheet" href="../css/client_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .container-fluid {
            border: 2px solid #ddd;
            /* Add a border with 2px width and light gray color */
            border-radius: 10px;
            /* Add border radius for rounded corners */
            padding: 15px;
            /* Add padding inside the border */
            box-shadow: 0 3px 12px rgba(255, 133, 162, 0.25);
            margin-top: 20px;
            border-color: pink;
            border-width: 4px;
        }

        .card_mt_3 {
            background-color: pink;
            border: 1px solid #ccc;
            padding: 20px;
            /* Reduced padding for compactness */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            margin-top: 2%;
            /* Reduced margin */
            width: 400px;
            height: auto;
            margin: 15px;
            font-size: 27px;
        }

        .row1 {
            justify-content: center;
            display: grid;
            width: 100%;
            grid-template-columns: auto auto auto;
        }

        .order{
            color: #000000;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <nav id="desktop-nav">
        <div class="logo">KB&D</div>
        <div>
            <ul class="nav-links">
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="orders.php">My Orders</a></li>
                <a href="cart.php"><i class='bx bx-cart'></i></a>
                <a href="javascript:void(0)" onclick="openNav()"><i class='bx bx-user'></i></a>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <h3 class = "order">My Orders</h3>
                    </div>
                </div>

                <div class="row1">
                    <?php
                    $sql_get_user_order = "SELECT DISTINCT 
                                            o.order_ref_number,
                                            pm.payment_method_desc,
                                            o.payment_method,
                                            op.order_phase_desc,
                                            o.order_phase,
                                            o.alternate_receiver,
                                            o.alternate_address,
                                            o.gcash_ref_num,
                                            o.gcash_account_name,
                                            o.gcash_account_number,
                                            o.gcash_amount_sent
                                        FROM orders as o
                                        JOIN payment_method as pm
                                        ON o.payment_method = pm.payment_method_id
                                        JOIN order_phase as op
                                        ON o.order_phase = op.order_phase_id
                                        WHERE o.user_id = '$s_user_id'";
                    $result_orders = mysqli_query($conn, $sql_get_user_order);

                    while ($rec = mysqli_fetch_assoc($result_orders)) { ?>
                        <div class="col-3">
                            <div class="card_mt_3">
                                <h6 class="card-title mt-1 ms-1">
                                    <?php echo $rec['order_ref_number'];
                                    $curr_order_ref_number = $rec['order_ref_number']; ?>
                                    <div class="float-end">
                                        <span class="badge rounded-pill text-bg-success"><?php echo $rec['payment_method_desc']; ?></span>
                                        <span class="badge rounded-pill 
                                            <?php
                                            switch ($rec['order_phase']) {
                                                case 0:
                                                    echo "text-bg-danger";
                                                    break;
                                                case 2:
                                                    echo "text-bg-primary";
                                                    break;
                                                case 3:
                                                    echo "text-bg-info";
                                                    break;
                                                case 4:
                                                    echo "text-bg-warning";
                                                    break;
                                                case 5:
                                                    echo "text-bg-success";
                                                    break;
                                                default:
                                                    echo "text-bg-secondary";
                                            } ?> "><?php echo $rec['order_phase_desc']; ?></span>
                                        <?php if ($rec['order_phase'] == '2') { ?>
                                            <a href="process_cancel_order.php?cancel_order=<?php echo $rec['order_ref_number']; ?>" class="btn btn-danger btn-sm me-1"> x </a>
                                        <?php } ?>
                                    </div>
                                </h6>
                                <?php if ($rec['payment_method'] == 1) { ?>
                                    <div class="card-caption p-2">
                                        <small class="small">Gcash Reference Number: <?php echo $rec['gcash_ref_num']; ?></small> <br>
                                        <small class="small">Gcash Account Name: <?php echo $rec['gcash_account_name']; ?></small> <br>
                                        <small class="small">Gcash Account Number: <?php echo $rec['gcash_account_number']; ?></small> <br>
                                        <small class="small">Gcash Amount Sent: <?php echo $rec['gcash_amount_sent']; ?></small>
                                    </div>
                                <?php } ?>
                                <?php
                                $sql_get_user_item_order = "SELECT 
                                                            i.item_name,
                                                            i.item_image,
                                                            i.item_price,
                                                            o.item_qty
                                                        FROM orders as o
                                                        JOIN items as i
                                                        ON o.items_id = i.items_id
                                                        WHERE o.user_id = '$s_user_id' 
                                                        AND o.order_ref_number = '$curr_order_ref_number'";
                                $result_item_orders = mysqli_query($conn, $sql_get_user_item_order); ?>
                                <div class="list-group">
                                    <?php $total_amt = 0.00;
                                    while ($io = mysqli_fetch_assoc($result_item_orders)) {
                                        $total_amt += $io['item_qty'] * $io['item_price']; ?>
                                        <li class="list-group-item">
                                            <img src="../uploads/<?php echo $io['item_image']; ?>" width="40px" alt="" class="img-fluid">
                                            <?php echo $io['item_name'] . " x " . $io['item_qty'] . " pcs"; ?>
                                            <small class="small float-end">Php <?php echo number_format($io['item_price'], 2); ?></small>
                                        </li>
                                    <?php } ?>
                                </div>
                                <div class="card-footer">
                                    <span class="float-end">Total Amount: <b>Php <?php echo number_format($total_amt, 2); ?></b></span>
                                </div>
                                <?php if ($rec['alternate_receiver'] != NULL) { ?>
                                    <div class="card-footer">
                                        <small class="small">
                                            <?php echo "Alternate Receiver: " . $rec['alternate_receiver'] . "<br>"; ?>
                                            <?php echo "Alternate Address: " . $rec['alternate_address'] . "<br>"; ?>
                                        </small>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'sidebar.php'; ?>
</body>
<script src="../js/bootstrap.js"></script>
<script>
    function openNav() {
        document.getElementById("mySidebar").classList.add("active");
    }

    function closeNav() {
        document.getElementById("mySidebar").classList.remove("active");
    }
</script>

</html>