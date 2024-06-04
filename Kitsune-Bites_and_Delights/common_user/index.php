<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];
if ($_SESSION['user_info_user_type'] != 'C') {
    header("location: ../index.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../index.php"); //go back to landing page of visitors page.
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


?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Client's Page</title>
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

        .card_mt-3 {
            background-color: pink;
            border: 1px solid #ccc;
            padding: 20px;
            /* Reduced padding for compactness */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            margin-top: 5%;
            /* Reduced margin */
            width: 400px;
            margin-bottom: 5%;
            font-size: 27px;
            margin-left: 20px;
        }
        .row1{
            display: flex;
        }
    </style>
</head>

<body>

    <!--HOMEPAGE FOR CLIENT -->
    <div class="home">



        <nav id="desktop-nav">
            <div class="logo">KB&D</div>
            <div>
                <ul class="nav-links">
                    <li><a href="#appetizers" onclick="toggleMenu()">Our Appetizers</a></li>
                    <li><a href="#sushi" onclick="toggleMenu()">Our Sushi</a></li>
                    <li><a href="#ramen" onclick="toggleMenu()">Our Ramen</a></li>
                    <li><a href="#beverages" onclick="toggleMenu()">Our Beverages</a></li>
                    <li><a href="#desserts" onclick="toggleMenu()">Our Dessert</a></li>
                    <a href="cart.php"><i class='bx bx-cart'></i></a>
                    <a href="javascript:void(0)" onclick="openNav()"><i class='bx bx-user'></i></a>
                </ul>

            </div>
        </nav>
        <div class="row">
            <div class="col-12">
                <h3 class="display-3">
                    Welcome <?php echo $_SESSION['user_info_fullname']; ?>!
                </h3>
            </div>
        </div>
        <div class="head">
            <div class="header">Explore Authentic Japanese Flavors Online With</div>
            <div class="header">With The Palm Of Your Hand</div>
        </div>
        <div><a class="order" href="?page=home">Order Now</a></div>
    </div>

    <?php if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <div class="col-8">
                                <hr>
                                <div class="col-8">
                                    <?php
                                    // Fetch distinct categories
                                    $categories = [
                                        "Appetizers" => "appetizers",
                                        "Sushi and Sashimi" => "sushi",
                                        "Ramen and Noodles" => "ramen",
                                        "Donburi Bowls" => "donburi",
                                        "Japanese Curry" => "curry",
                                        "Yakitori and Kushiyaki" => "yakitori",
                                        "Hot Pot (Nabe)" => "nabe",
                                        "Desserts" => "desserts",
                                        "Beverages" => "beverages"
                                    ];

                                    $sql_get_categories = "SELECT DISTINCT `item_category` FROM `items` WHERE `item_status`='A'";
                                    $get_categories_result = mysqli_query($conn, $sql_get_categories);

                                    while ($category_row = mysqli_fetch_assoc($get_categories_result)) {
                                        $category = $category_row['item_category'];
                                        $category_id = $categories[$category];
                                        echo "<div class='category-section' id='$category_id'>";
                                        echo "<h2 class='category-title'>" . htmlspecialchars($category) . "</h2>";
                                        echo "<div class='item-list'>";

                                        $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' AND `item_category`='$category' ORDER BY items_id DESC";
                                        $get_items_result = mysqli_query($conn, $sql_get_items);

                                        while ($row = mysqli_fetch_assoc($get_items_result)) {
                                            echo "<div class='item' onclick='toggleDescription(this)'>";
                                            echo "<img src='../uploads/" . htmlspecialchars($row['item_image']) . "' alt='' class='item-image'>";
                                            echo "<div class='item-info'>";
                                            echo "<h4 class='item-name'>" . htmlspecialchars($row['item_name']) . "</h4>";
                                            echo "<form action='process_add_to_cart.php' href='?home=page' method='get' class='form-inline'>";
                                            echo "<input type='hidden' name='item_id' value='" . $row['items_id'] . "'>";
                                            echo "<input type='number' class='form-control mb-2 mr-sm-2' name='cart_qty' placeholder='Quantity' required>";
                                            echo "<button type='submit' class='btn btn-primary mb-2'>Add to Cart</button>";
                                            echo "</form>";
                                            echo "<div class='item-desc' style='display: none;'>";
                                            echo htmlspecialchars($row['item_desc']);
                                            echo "</div>";
                                            echo "<p class='item-price'>Php " . number_format($row['item_price'], 2) . "</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }

                                        echo "</div>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="col-3">
                        <!-- Cart-->

                    <?php } else if ($_GET['page'] == 'myorder') { ?>
                        <div class="row1">

                            <?php
                            $sql_get_user_order = "SELECT DISTINCT 
                                                    o.order_ref_number
                                                    , pm.payment_method_desc
                                                    , o.payment_method
                                                    , op.order_phase_desc
                                                    , o.order_phase
                                                    , o.alternate_receiver
                                                    , o.alternate_address
                                                    , o.gcash_ref_num
                                                    , o.gcash_account_name
                                                    , o.gcash_account_number
                                                    , o.gcash_amount_sent
                                                FROM `orders` as o
                                                JOIN `payment_method` as pm
                                                ON o.payment_method = pm.payment_method_id
                                                JOIN `order_phase` as op
                                                ON o.order_phase = op.order_phase_id
                                                WHERE o.user_id = '$s_user_id' ";
                            $result_orders = mysqli_query($conn, $sql_get_user_order);


                            while ($rec = mysqli_fetch_assoc($result_orders)) { //first loop with only the order_reference_number 
                            ?>
                                <div class="col-3">
                                    <div class="card_mt-3">
                                        <h6 class="card-title mt-1 ms-1"><?php
                                                                            echo $rec['order_ref_number'];
                                                                            $curr_order_ref_number = $rec['order_ref_number'];
                                                                            ?>
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
                                                            }
                                                            ?> "><?php echo $rec['order_phase_desc']; ?></span>
                                                <?php if ($rec['order_phase'] == '2') { ?>
                                                    <a href="process_cancel_order.php?cancel_order=<?php echo $rec['order_ref_number']; ?>" class="btn btn-danger btn-sm me-1"> x </a>
                                                <?php } ?>
                                            </div>

                                        </h6>
                                        <?php
                                        if ($rec['payment_method'] == 1) {  ?>
                                            <div class="card-caption p-2">
                                                <small class="small">Gcash Reference Number: <?php echo $rec['gcash_ref_num']; ?></small> <br>
                                                <small class="small">Gcash Account Name: <?php echo $rec['gcash_account_name']; ?></small> <br>
                                                <small class="small">Gcash Account Number: <?php echo $rec['gcash_account_number']; ?></small> <br>
                                                <small class="small">Gcash Amount Sent: <?php echo $rec['gcash_amount_sent']; ?></small>
                                            </div>
                                        <?php }
                                        ?>
                                        <?php
                                        $sql_get_user_item_order = "SELECT 
                                                                            i.item_name
                                                                            , i.item_image
                                                                            , i.item_price
                                                                            , o.item_qty
                                                                        FROM `orders` as o
                                                                        JOIN `items` as i
                                                                            ON o.items_id = i.items_id
                                                                        WHERE o.user_id = '$s_user_id' 
                                                                            AND o.order_ref_number = '$curr_order_ref_number'";
                                        $result_item_orders = mysqli_query($conn, $sql_get_user_item_order); ?>
                                        <div class="list-group">
                                            <?php $total_amt = 0.00;
                                            while ($io = mysqli_fetch_assoc($result_item_orders)) {
                                                $total_amt = $total_amt + ($io['item_qty'] * $io['item_price']);
                                            ?>
                                                <li class="list-group-item">
                                                    <img src="../uploads/<?php echo $io['item_image']; ?>" width="40px" alt="" class="img-fluid">
                                                    <?php echo $io['item_name'] . " x "; ?>
                                                    <?php echo $io['item_qty'] . " pcs <br>"; ?>
                                                    <small class="small float-end"> <?php echo "Php " . number_format($io['item_price'], 2); ?></small>
                                                </li>
                                            <?php } ?>


                                        </div>
                                        <div class="card-footer">
                                            <span class="float-end"> Total Amount: <b> <?php echo "Php " . number_format($total_amt, 2); ?> </b> </span>
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
                            <?php }
                            ?>

                        </div>
                <?php }
            }

                ?>

                <?php include 'sidebar.php'; ?>


</body>
<script src="../js/bootstrap.js"></script>

<script>
    function toggleDescription(element) {
        var description = element.querySelector('.item-desc');
        if (description.style.display === 'none' || description.style.display === '') {
            description.style.display = 'block';
        } else {
            description.style.display = 'none';
        }
    }
</script>

<script>
    function toggleMenu() {
        const menuLinks = document.querySelector('.menu-links');
        menuLinks.classList.toggle('active');
    }

    function toggleDescription(element) {
        const description = element.querySelector('.item-desc');
        if (description.style.display === 'none') {
            description.style.display = 'block';
        } else {
            description.style.display = 'none';
        }
    }

    function openNav() {
        document.getElementById("mySidebar").classList.add("active");
    }

    function closeNav() {
        document.getElementById("mySidebar").classList.remove("active");
    }
</script>

<script>
    // Function to parse URL parameters
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Function to show the success message if it exists in the URL
    function showSuccessMessage() {
        var successMessage = getParameterByName('msg');
        if (successMessage === '1') {
            var messageContainer = document.createElement('div');
            messageContainer.className = 'success-message';
            messageContainer.textContent = 'Order placed successfully.';
            document.body.appendChild(messageContainer);

            // After 3 seconds, remove the message
            setTimeout(function() {
                document.body.removeChild(messageContainer);
            }, 3000);
        }
    }

    // Call the function to show the success message
    showSuccessMessage();
</script>



</html>