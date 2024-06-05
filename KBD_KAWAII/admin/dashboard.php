<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        th {
            background-color: pink;
        }

        #searchInput {
            width: 50%;
            padding: 10px 10px 10px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Dashboard</h1>

    <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search...">

    <script>
    function searchFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByTagName("table");
        for (var k = 0; k < table.length; k++) {
            tr = table[k].getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                // Skip the first row (table header)
                if (i === 0) continue;
                var found = false;
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "kitsune_bites_and_delights"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update total sales per date
    $sql_update_total_per_date = "INSERT INTO total_per_date (date, total_item_qty, total_sales)
                                  SELECT DATE(o.date_added) AS date, 
                                         SUM(o.item_qty) AS total_item_qty, 
                                         SUM(o.item_qty * i.item_price) AS total_sales
                                  FROM orders o
                                  INNER JOIN items i ON o.items_id = i.items_id
                                  WHERE o.order_phase = '5' -- Only consider delivered orders
                                  GROUP BY DATE(o.date_added)
                                  ON DUPLICATE KEY UPDATE
                                  total_item_qty = VALUES(total_item_qty),
                                  total_sales = VALUES(total_sales)";
    $conn->query($sql_update_total_per_date);

    // Update total sales per item
    $sql_insert_total_per_item = "INSERT INTO total_per_item (date, total_per_item_id, total_item_qty, total_sales, item_name)
                                  SELECT DATE(o.date_added) AS date, 
                                        o.items_id, 
                                        SUM(o.item_qty) AS total_item_qty, 
                                        SUM(o.item_qty * i.item_price) AS total_sales,
                                        i.item_name
                                  FROM orders o
                                  INNER JOIN items i ON o.items_id = i.items_id
                                  WHERE o.order_phase = '5'
                                  GROUP BY DATE(o.date_added), o.items_id
                                  ON DUPLICATE KEY UPDATE
                                  total_item_qty = VALUES(total_item_qty),
                                  total_sales = VALUES(total_sales)";
    $conn->query($sql_insert_total_per_item);

    // Update total sales per order
    $sql_update_total_per_order = "INSERT INTO total_per_order (order_ref_number, total_item_qty, total_sales)
                                   SELECT order_ref_number, 
                                          SUM(item_qty) AS total_item_qty, 
                                          SUM(item_qty * i.item_price) AS total_sales
                                   FROM orders o
                                   INNER JOIN items i ON o.items_id = i.items_id
                                   WHERE o.order_phase = '5' -- Only consider delivered orders
                                   GROUP BY order_ref_number
                                   ON DUPLICATE KEY UPDATE
                                   total_item_qty = VALUES(total_item_qty),
                                   total_sales = VALUES(total_sales)";
    $conn->query($sql_update_total_per_order);

    // Update total sales per user
    $sql_update_total_per_user = "UPDATE total_per_user AS tpu
                                  INNER JOIN (
                                      SELECT u.username,
                                             SUM(o.item_qty) AS total_item_qty,
                                             SUM(o.item_qty * i.item_price) AS total_sales
                                      FROM orders o
                                      INNER JOIN user_info u ON o.user_id = u.user_info_id
                                      INNER JOIN items i ON o.items_id = i.items_id
                                      WHERE o.order_phase = '5' -- Only consider delivered orders
                                      GROUP BY u.username
                                  ) AS tmp ON tpu.username = tmp.username
                                  SET tpu.total_item_qty = tmp.total_item_qty,
                                      tpu.total_sales = tmp.total_sales";
    $conn->query($sql_update_total_per_user);
    ?>

    <h2>Total Sales Per Date</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Total Item Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php
        // Fetch and display total sales per date
        $sql_select_total_per_date = "SELECT date, total_item_qty, total_sales FROM total_per_date";
        $result_date = $conn->query($sql_select_total_per_date);
        if ($result_date->num_rows > 0) {
            while ($row_date = $result_date->fetch_assoc()) {
                echo "<tr><td>" . $row_date["date"] . "</td><td>" . $row_date["total_item_qty"] . "</td><td>" . $row_date["total_sales"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>

    <h2>Total Sales Per Item</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Item Name</th>
            <th>Total Item Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php
        // Fetch and display total sales per item
        $sql_select_total_per_item = "SELECT date, item_name, total_item_qty, total_sales FROM total_per_item";
        $result_item = $conn->query($sql_select_total_per_item);
        if ($result_item->num_rows > 0) {
            while ($row_item = $result_item->fetch_assoc()) {
                echo "<tr><td>" . $row_item["date"] . "</td><td>" . $row_item["item_name"] . "</td><td>" . $row_item["total_item_qty"] . "</td><td>" . $row_item["total_sales"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }
        ?>
    </table>
    <h2>Total Sales Per Order</h2>
    <table>
        <tr>
            <th>Order Reference Number</th>
            <th>Total Item Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php
        // Fetch and display total sales per order
        $sql_select_total_per_order = "SELECT order_ref_number, total_item_qty, total_sales FROM total_per_order";
        $result_order = $conn->query($sql_select_total_per_order);
        if ($result_order->num_rows > 0) {
            while ($row_order = $result_order->fetch_assoc()) {
                echo "<tr><td>" . $row_order["order_ref_number"] . "</td><td>" . $row_order["total_item_qty"] . "</td><td>" . $row_order["total_sales"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>

    <h2>Total Sales Per User</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Username</th>
            <th>Total Item Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php
        // Fetch and display total sales per user
        $sql_select_total_per_user = "SELECT fullname, username, total_item_qty, total_sales FROM total_per_user";
        $result_user = $conn->query($sql_select_total_per_user);
        if ($result_user->num_rows > 0) {
            while ($row_user = $result_user->fetch_assoc()) {
                echo "<tr><td>" . $row_user["fullname"] . "</td><td>" . $row_user["username"] . "</td><td>" . $row_user["total_item_qty"] . "</td><td>" . $row_user["total_sales"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>

</html>
