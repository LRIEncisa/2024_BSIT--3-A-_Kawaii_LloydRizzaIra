<?php
include_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect all form data
    $itemName = $_POST['f_item_name'];
    $itemDesc = $_POST['f_item_desc'];
    $itemPrice = $_POST['f_item_price'];
    $itemCategory = $_POST['f_item_category'];
    $itemImage = $_FILES['f_item_image']['name'];

    // File upload process here
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["f_item_image"]["name"]);

    if (move_uploaded_file($_FILES["f_item_image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["f_item_image"]["name"])) . " has been uploaded.";
    } else {
        echo "Error uploading your file.";
    }

    // SQL to insert new item into the database
    $sql = "INSERT INTO items (item_name, item_desc, item_price, item_category, item_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $itemName, $itemDesc, $itemPrice, $itemCategory, $itemImage);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.php?insert_status=1");
    } else {
        header("Location: index.php?insert_status=0");
    }
    $stmt->close();
    $conn->close();
}
?>
