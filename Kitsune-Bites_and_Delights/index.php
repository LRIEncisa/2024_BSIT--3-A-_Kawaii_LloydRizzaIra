<?php
include_once "db.php";
session_start();

// Check if the session variable is set before using it
if (isset($_SESSION['user_info_user_type'])) {
    if ($_SESSION['user_info_user_type'] == 'A') {
        header("location: admin/");
        exit; // Don't forget to call exit after header redirection
    }

    if ($_SESSION['user_info_user_type'] == 'C') {
        header("location: common_user/");
        exit; // Don't forget to call exit after header redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors Page</title>
    <link rel="stylesheet" href="css/visitor_page.css"> <!-- css sa mga items -->
    <link rel="stylesheet" href="css/login.css"> <!-- css sa login form -->
    <link rel="stylesheet" href="css/home.css"> <!-- css sa home page ng visitor -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    <!-- visitor home page-->
    <div class="home">
        <nav id="desktop-nav">
            <div class="logo">KB&D</div>
            <div>
                <ul class="nav-links">
                    <li><a href="#appetizers">Our Appetizers</a></li>
                    <li><a href="#sushi">Our Sushi</a></li>
                    <li><a href="#ramen">Our Ramen</a></li>
                    <li><a href="#beverages">Our Beverages</a></li>
                    <li><a href="#desserts">Our Dessert</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
        <div class="head">
            <div class="header">Explore Authentic Japanese Flavors Online With</div>
            <div class="header">With The Palm Of Your Hand</div>
        </div>
        <div><a class="order" href="?page=home">Our Menu</a></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4 bg-success text-light">
                <!-- Add login button -->
            </div>
            <div class="col-8">
                <?php
                // Fetch items and group them by category
                $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' ORDER BY `item_category`, `items_id` DESC";
                $get_result = mysqli_query($conn, $sql_get_items);
                $items_by_category = [];

                // Group items by category
                while ($row = mysqli_fetch_assoc($get_result)) {
                    $items_by_category[$row['item_category']][] = $row;
                }

                // Define category IDs
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

                // Display items grouped by category
                foreach ($items_by_category as $category => $items) {
                    // Map category name to ID
                    $category_id = $categories[$category];
                    echo "<div id='{$category_id}' class='category-section'>";
                    echo "<h2 class='category-title'>" . htmlspecialchars($category) . "</h2>";
                    echo "<div class='item-list'>";
                    foreach ($items as $item) {
                        echo "<div class='item' onclick='showDetails(this)'>";
                        echo "<img src='uploads/" . htmlspecialchars($item['item_image']) . "' alt='' class='item-image'>";
                        echo "<div class='item-info'>";
                        echo "<h4 class='item-name'>" . htmlspecialchars($item['item_name']) . "</h4>";
                        echo "<p class='item-price'>Php " . number_format($item['item_price'], 2) . "</p>";
                        echo "</div>";
                        echo "<div class='item-details'>";
                        echo "<p class='item-category'>" . htmlspecialchars($item['item_category']) . "</p>";
                        echo "<p class='item-desc'>" . htmlspecialchars($item['item_desc']) . "</p>";
                        echo "<a href='login.php' class='btn btn-primary'>Login to Buy</a>";
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

    <script>
        function showDetails(item) {
            var details = item.getElementsByClassName('item-details')[0];
            var isVisible = details.style.display === 'block';
            details.style.display = isVisible ? 'none' : 'block';
        }

        // Smooth scroll for nav links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>