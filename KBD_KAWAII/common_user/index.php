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
</head>

<style>
.search-container {
    margin-bottom: 20px; /* Adjust as needed */
}

#noItemsMessage {
    display: none;
    color: #dc3545; /* Adjust color as needed */
    font-size: 18px; /* Adjust font size as needed */
    font-style: italic;
    margin-top: 20px; /* Adjust margin as needed */
    text-align: center; /* Center the message */
    padding: 10px; /* Add padding for better readability */
    background-color: #f8d7da; /* Background color for better contrast */
    border: 1px solid #dc3545; /* Border color for better visibility */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow for depth */
}

.search-container {
    margin: 20px 0;
    text-align: center;
    position: relative;
    display: inline-block;
    width: 100%;
}

/* Styling for the search input */
.search-container input[type="text"] {
    width: 50%;
    padding: 10px 10px 10px 40px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>

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

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="filterItems()" placeholder="Search for items...">
    </div>

    <div id="noItemsMessage" style="display: none;">No items found.</div>

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

                                    $sql_get_categories = "SELECT DISTINCT item_category FROM items WHERE `item_status`='A'";
                                    $get_categories_result = mysqli_query($conn, $sql_get_categories);

                                    while ($category_row = mysqli_fetch_assoc($get_categories_result)) {
                                        $category = $category_row['item_category'];
                                        $category_id = $categories[$category];
                                        echo "<div class='category-section' id='$category_id'>";
                                        echo "<h2 class='category-title'>" . htmlspecialchars($category) . "</h2>";
                                        echo "<div class='item-list'>";

                                        $sql_get_items = "SELECT * FROM items WHERE `item_status`='A' AND `item_category`='$category' ORDER BY `items_id` DESC";
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

    function toggleMenu() {
        const menuLinks = document.querySelector('.menu-links');
        menuLinks.classList.toggle('active');
    }

    function openNav() {
        document.getElementById("mySidebar").classList.add("active");
    }

    function closeNav() {
        document.getElementById("mySidebar").classList.remove("active");
    }

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
            setTimeout(function () {
                document.body.removeChild(messageContainer);
            }, 3000);
        }
    }

    // Call the function to show the success message
    showSuccessMessage();
</script>

<script>
    function filterItems() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var items = document.querySelectorAll('.item');
        var noItemsMessage = document.getElementById('noItemsMessage');
        var found = false;

        items.forEach(function(item) {
            var itemName = item.querySelector('.item-name').textContent.toLowerCase();
            if (itemName.includes(input)) {
                item.style.display = 'block';
                found = true;
            } else {
                item.style.display = 'none';
            }
        });

        // Loop through category sections and hide those with no visible items
        var categorySections = document.querySelectorAll('.category-section');
        categorySections.forEach(function(section) {
            var visibleItems = section.querySelectorAll('.item:not([style*="display: none"])');
            if (visibleItems.length > 0) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });

        if (found) {
            noItemsMessage.style.display = 'none';
        } else {
            noItemsMessage.style.display = 'block';
        }
    }
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>