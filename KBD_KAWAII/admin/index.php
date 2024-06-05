<html>
<?php
include_once "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];
if ($_SESSION['user_info_user_type'] != 'A') {
    header("location: ../index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../index.php");
    exit();
}
$orderphase = isset($_GET['orderphase']) ? $_GET['orderphase'] : '';
?>

<head>
    <meta charset="UTF-8">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="../css/manage_items.css">
    <link rel="stylesheet" href="../css/admin_home.css">

</head>

<head>
    <meta charset="UTF-8">
    <title>Client's Page</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/item_container.css">
    <link rel="stylesheet" href="../css/client_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>


<body>
    <a href="?logout" class="btn btn-link">Logout</a>
    <div class="logo">KB&D</div>
    <div class="head">
        <div class="header welcome-text">Welcome, Admin!</div>
        <div class="header">Manage your items here.</div>
    </div>
    <div class="container">
        <a href="?manageitems" class="btn btn-link">Manage Items</a>
        <a href="?manageorder" class="btn btn-link">Manage Orders</a>
        <a href="?dashboard" class="btn btn-link">Dashboards</a>

        <div class="container">
            <?php if (isset($_GET['manageitems'])) { ?>
                <div class="row">
                    <div class="col-4 bg-success text-light">
                        <?php
                        if (isset($_GET['deactivate_item'])) {
                            $item_id = $_GET['deactivate_item'];
                            $sql_deactivate_item = "UPDATE `items` SET `item_status`='I' WHERE `items_id`='$item_id'";
                            mysqli_query($conn, $sql_deactivate_item);
                            header("Location: index.php?manageitems");
                            exit();
                        }

                        if (isset($_GET['update_item'])) {
                            $item_id = $_GET['update_item'];
                            $sql_get_item_info = "SELECT * FROM `items` WHERE items_id = '$item_id'";
                            $result = mysqli_query($conn, $sql_get_item_info);
                            $data_row = mysqli_fetch_assoc($result);
                            ?>
                            <h3 class="display-6">Update Item Info</h3>
                            <form action="process_update_item.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="f_item_id" value="<?php echo $item_id; ?>">
                                <label for="">Item Name</label>
                                <input type="text" name="f_item_name" class="form-control mb-3"
                                    value="<?php echo htmlspecialchars($data_row['item_name']); ?>">

                                <label for="">Item Description</label>
                                <input type="text" name="f_item_desc" class="form-control mb-3"
                                    value="<?php echo htmlspecialchars($data_row['item_desc']); ?>">

                                <label for="">Item Price</label>
                                <input type="text" name="f_item_price" class="form-control mb-3"
                                    value="<?php echo htmlspecialchars($data_row['item_price']); ?>">

                                <label for="f_item_category">Category</label>
                                <select name="f_item_category" class="form-control mb-3">
                                    <option value="Appetizers" <?php if ($data_row['item_category'] == 'Appetizers')
                                        echo 'selected'; ?>>Appetizers</option>
                                    <option value="Sushi and Sashimi" <?php if ($data_row['item_category'] == 'Sushi and Sashimi')
                                        echo 'selected'; ?>>Sushi and Sashimi</option>
                                    <option value="Ramen and Noodles" <?php if ($data_row['item_category'] == 'Ramen and Noodles')
                                        echo 'selected'; ?>>Ramen and Noodles</option>
                                    <option value="Donburi Bowls" <?php if ($data_row['item_category'] == 'Donburi Bowls')
                                        echo 'selected'; ?>>Donburi Bowls</option>
                                    <option value="Japanese Curry" <?php if ($data_row['item_category'] == 'Japanese Curry')
                                        echo 'selected'; ?>>Japanese Curry</option>
                                    <option value="Yakitori and Kushiyaki" <?php if ($data_row['item_category'] == 'Yakitori and Kushiyaki')
                                        echo 'selected'; ?>>Yakitori and Kushiyaki</option>
                                    <option value="Hot Pot (Nabe)" <?php if ($data_row['item_category'] == 'Hot Pot (Nabe)')
                                        echo 'selected'; ?>>Hot Pot (Nabe)</option>
                                    <option value="Desserts" <?php if ($data_row['item_category'] == 'Desserts')
                                        echo 'selected'; ?>>Desserts</option>
                                    <option value="Beverages" <?php if ($data_row['item_category'] == 'Beverages')
                                        echo 'selected'; ?>>Beverages</option>
                                </select>

                                <label for="itemImage">Item Image</label>
                                <input type="file" name="f_item_image" class="form-control mb-3" id="itemImage">

                                <input type="submit" class="btn btn-primary" value="Update Item">
                            </form>
                            <?php
                        }
                        ?>

                        <hr>
                        <h3 class="display-6">Add New Item</h3>
                        <?php
                        if (isset($_GET['insert_status'])) {
                            echo "<div class='alert alert-warning'>";
                            if ($_GET['insert_status'] == '1') {
                                echo "Item Added Successfully.";
                            } else {
                                echo "There was an error.";
                            }
                            echo "</div>";
                        }
                        ?>
                        <form action="process_new_item.php" method="post" enctype="multipart/form-data">
                            <label for="">Item Name</label>
                            <input type="text" name="f_item_name" class="form-control mb-3">

                            <label for="">Item Description</label>
                            <input type="text" name="f_item_desc" class="form-control mb-3">

                            <label for="f_item_category">Category</label>
                            <select name="f_item_category" class="form-control mb-3">
                                <option value="Appetizers">Appetizers</option>
                                <option value="Sushi and Sashimi">Sushi and Sashimi</option>
                                <option value="Ramen and Noodles">Ramen and Noodles</option>
                                <option value="Donburi Bowls">Donburi Bowls</option>
                                <option value="Japanese Curry">Japanese Curry</option>
                                <option value="Yakitori and Kushiyaki">Yakitori and Kushiyaki</option>
                                <option value="Hot Pot (Nabe)">Hot Pot (Nabe)</option>
                                <option value="Desserts">Desserts</option>
                                <option value="Beverages">Beverages</option>
                            </select>

                            <label for="">Item Price</label>
                            <input type="text" name="f_item_price" class="form-control mb-3">

                            <label for="itemImage">Item Image</label>
                            <input type="file" name="f_item_image" class="form-control mb-3" id="itemImage">

                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div>

                    <div class="col-8">
                        <?php
                        $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' ORDER BY items_id DESC";
                        $get_result = mysqli_query($conn, $sql_get_items);
                        ?>
                        <div class="item-container">
                            <?php while ($row = mysqli_fetch_assoc($get_result)) { ?>
                                <div class="item">
                                    <img src="../uploads/<?php echo htmlspecialchars($row['item_image']); ?>" alt=""
                                        class="item-image">
                                    <div class="item-info">
                                        <h4 class="item-name"><?php echo htmlspecialchars($row['item_name']); ?></h4>
                                        <p class="item-price"><?php echo "Php " . number_format($row['item_price'], 2); ?></p>
                                    </div>
                                    <div class="item-details">
                                        <p class="item-category"><?php echo htmlspecialchars($row['item_category']); ?></p>
                                        <p class="item-desc"><?php echo htmlspecialchars($row['item_desc']); ?></p>
                                        <a href="index.php?manageitems&update_item=<?php echo $row['items_id']; ?>"
                                            class="btn btn-success">Update</a>
                                        <a href="?manageitems&deactivate_item=<?php echo $row['items_id']; ?>"
                                            class="btn btn-danger">Deactivate</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (isset($_GET['manageorder'])) { ?>
                <div class="row">
                    <div class="col-12">
                        <h3 class="display-3">Orders</h3>
                        <a href="?manageorder&orderphase=2" class="btn btn-link">New</a>
                        <a href="?manageorder&orderphase=3" class="btn btn-link">Pending</a>
                        <a href="?manageorder&orderphase=4" class="btn btn-link">To Ship</a>
                        <a href="?manageorder&orderphase=5" class="btn btn-link">Delivered</a>
                        <a href="?manageorder&orderphase=0" class="btn btn-link">Cancelled</a>
                        <input type="text" id="orderSearch" onkeyup="searchOrders()" placeholder="Search orders">
                    </div>
                    <div class="container-fluid">
                        <?php
                        if (isset($_GET['orderphase']) && isset($_GET['manageorder'])) {
                            $orderphase = $_GET['orderphase'];
                            ?>
                            <div class="row">
                                <?php
                                $sql_get_user_order = "SELECT DISTINCT 
                                                        o.order_ref_number
                                                      , date(o.date_added) as date_added
                                                      , pm.payment_method_desc
                                                      , o.payment_method
                                                      , op.order_phase_admin
                                                      , o.order_phase
                                                      , ui.fullname
                                                      , ui.address
                                                      , o.gcash_ref_num
                                                      , o.gcash_account_name
                                                      , o.gcash_account_number
                                                      , o.gcash_amount_sent
                                                   FROM `orders` as o
                                                   JOIN `payment_method` as pm
                                                     ON o.payment_method = pm.payment_method_id
                                                   JOIN `order_phase` as op
                                                     ON o.order_phase = op.order_phase_id
                                                   JOIN `user_info` as ui
                                                     ON o.user_id = ui.user_info_id
                                                  WHERE ui.user_type = 'C'
                                                    AND ui.user_status = 'A'
                                                    AND o.order_phase = '$orderphase'
                                                  ORDER BY o.date_added ASC";
                                $result_orders = mysqli_query($conn, $sql_get_user_order);
                                while ($ro = mysqli_fetch_assoc($result_orders)) { //first loop for the order reference number 
                                    ?>
                                    <div class="col-3">
                                        <div class="card p-3">
                                            <div class="float-end">
                                                <span
                                                    class="badge rounded-pill text-bg-primary"><?php echo $ro['payment_method_desc']; ?></span>
                                                <span class="badge rounded-pill 
                                                  <?php
                                                  switch ($ro['order_phase']) {
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
                                                  }
                                                  ?> "><?php echo $ro['order_phase_admin']; ?></span>
                                                <?php if ($ro['order_phase'] == '2') { ?>
                                                    <a href="process_cancel_order.php?cancel_order=<?php echo $ro['order_ref_number']; ?>"
                                                        class="btn btn-danger btn-sm me-1"> x </a>
                                                <?php } ?>
                                            </div>
                                            <p class="card-title">
                                                <small><i><?php echo $ro['date_added']; ?></i></small> <br>
                                                <b><?php echo $ro['order_ref_number']; ?></b> <br>
                                                <small>Recipient: <?php echo strtoupper($ro['fullname']); ?></small> <br>
                                                <small>Address: <?php echo strtoupper($ro['address']); ?></small>
                                            </p>
                                            <?php if ($ro['payment_method'] == 1 && $ro['order_phase'] == '2') { ?>
                                                <div class="card-caption p-2">
                                                    <small class="small">Gcash Reference Number:
                                                        <?php echo $ro['gcash_ref_num']; ?></small> <br>
                                                    <small class="small">Gcash Account Name:
                                                        <?php echo $ro['gcash_account_name']; ?></small> <br>
                                                    <small class="small">Gcash Account Number:
                                                        <?php echo $ro['gcash_account_number']; ?></small> <br>
                                                    <small class="small">Gcash Amount Sent:
                                                        <?php echo $ro['gcash_amount_sent']; ?></small>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            $curr_order_ref_number = "";
                                            $curr_order_ref_number = $ro['order_ref_number'];
                                            $sql_get_order_items = "SELECT i.item_name
                                                                      , i.item_image
                                                                      , i.item_price
                                                                      , o.item_qty
                                                                   FROM `orders` as o
                                                                   JOIN `items` as i
                                                                     ON o.items_id = i.items_id
                                                                    WHERE o.order_ref_number = '$curr_order_ref_number'";
                                            $order_items_result = mysqli_query($conn, $sql_get_order_items);
                                            ?>
                                            <ul class="list-group">
                                                <?php
                                                $total_amt = 0.00;
                                                while ($itord = mysqli_fetch_assoc($order_items_result)) {
                                                    //inner 2nd loop to list all the items of the specified order reference number 
                                                    ?>
                                                    <li class="list-group-item">
                                                        <?php echo $itord['item_name'] . " x " . $itord['item_qty'] . " = <br><small>" . "Php " . number_format($itord['item_qty'] * $itord['item_price'], 2) . "</small>"; ?>
                                                    </li>
                                                    <?php
                                                    $total_amt += $itord['item_qty'] * $itord['item_price'];
                                                } ?>
                                                <li class="list-group-item bg-secondary text-light">
                                                    <?php echo "Php " . number_format($total_amt, 2); ?>
                                                </li>
                                                <?php if ($_GET['orderphase'] == '2') { ?>
                                                    <li class="list-group-item">
                                                        <a href="process_confirm_order.php?confirm_order=<?php echo $curr_order_ref_number; ?>"
                                                            class="btn btn-success">Confirm</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($_GET['orderphase'] == '3') { ?>
                                                    <li class="list-group-item">
                                                        <a href="process_confirm_order.php?ship_order=<?php echo $curr_order_ref_number; ?>"
                                                            class="btn btn-primary">Ship</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($_GET['orderphase'] == '4') { ?>
                                                    <li class="list-group-item">
                                                        <a href="process_confirm_order.php?complete_order=<?php echo $curr_order_ref_number; ?>"
                                                            class="btn btn-primary">Complete</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_GET['dashboard'])) {
                include_once "dashboard.php";
            } ?>
        </div>
    </div>
</body>
<script src="../js/bootstrap.js"></script>

<script>
    function searchOrders() {
        var input, filter, cards, cardContainer, title, i;
        input = document.getElementById("orderSearch");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementsByClassName("container-fluid")[0]; // Assuming order cards are inside the first container-fluid element
        cards = cardContainer.getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".card-title");
            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }


</script>

</html>