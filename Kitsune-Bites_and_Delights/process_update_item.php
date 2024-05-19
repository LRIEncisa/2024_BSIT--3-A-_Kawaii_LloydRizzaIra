<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $item_name = $_POST['f_item_name'];
    $item_desc = $_POST['f_item_desc'];
    $item_price = $_POST['f_item_price'];
    $item_image = $_FILES['f_item_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['f_item_image']['name']);

    // Move the uploaded file to the 'uploads' directory
    if (move_uploaded_file($_FILES['f_item_image']['tmp_name'], $target_file)) {
        // Insert data into database
        $sql = "INSERT INTO items (item_name, item_desc, item_price, item_image) VALUES ('$item_name', '$item_desc', '$item_price', '$item_image')";
        if(mysqli_query($conn, $sql)) {
            header('Location: index.php?insert_status=1');
        } else {
            header('Location: index.php?insert_status=0');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
