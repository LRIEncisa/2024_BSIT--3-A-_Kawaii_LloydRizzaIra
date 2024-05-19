<?php
include_once "db.php";

$fullname = $_POST['r_fullname'];
$uname = $_POST['r_username'];
$passwd = $_POST['r_password']; // Using the correct POST variable name
$conf_passwd = $_POST['r_conf_password']; // Using the correct POST variable name
$address = $_POST['r_address'];
$contact = $_POST['r_contact'];
$gender = $_POST['r_gender'];

function chk_pass($p1, $p2) {
    return ($p1 === $p2);
}

if (!chk_pass($passwd, $conf_passwd)) {
    header("location: registration.php?error=password_mismatch");
    exit;
}

// Check if the username already exists
$sql_chk_user = "SELECT user_info_id FROM user_info WHERE username = ?";
$stmt = $conn->prepare($sql_chk_user);
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    // User already exists
    header("location: registration.php?error=user_already_exist");
    exit;
} else {
    // User can register, insert data with plaintext password (not recommended)
    $sql_new_user = "INSERT INTO user_info (username, password, fullname, address, contact_no, gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_new_user);
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssss", $uname, $passwd, $fullname, $address, $contact, $gender);
    if (!$stmt->execute()) {
        header("location: registration.php?error=Insert_Failed");
        exit;
    }

    $stmt->close();
    $conn->close();
    header("location: index.php?msg=successfully_registered");
    exit;
}
?>
