<?php
include_once "../db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['f_item_id'];
    $item_name = $_POST['f_item_name'];
    $item_desc = $_POST['f_item_desc'];
    $item_price = $_POST['f_item_price'];
    $item_category = $_POST['f_item_category'];

    // Handle the file upload if a new image is provided
    if (!empty($_FILES['f_item_image']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['f_item_image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($_FILES['f_item_image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['f_item_image']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['f_item_image']['tmp_name'], $target_file)) {
                $item_image = basename($_FILES['f_item_image']['name']);
                $sql_update_item = "UPDATE `items` 
                                    SET `item_name`='$item_name', 
                                        `item_desc`='$item_desc', 
                                        `item_price`='$item_price', 
                                        `item_category`='$item_category', 
                                        `item_image`='$item_image' 
                                    WHERE `items_id`='$item_id'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // If no new image is provided, update the other fields only
        $sql_update_item = "UPDATE `items` 
                            SET `item_name`='$item_name', 
                                `item_desc`='$item_desc', 
                                `item_price`='$item_price', 
                                `item_category`='$item_category' 
                            WHERE `items_id`='$item_id'";
    }

    if (mysqli_query($conn, $sql_update_item)) {
        header("Location: index.php?manageitems");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>