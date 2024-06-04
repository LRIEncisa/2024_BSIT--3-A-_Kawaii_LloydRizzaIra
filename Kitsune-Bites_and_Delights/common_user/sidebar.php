<?php

if (!isset($_SESSION['user_info_id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="index.php?page=home">Home</a>
    <a href="orders.php">My Orders</a>
    <a href="index.php?logout">Logout</a>
</div>

<script>
    function openNav() {
        document.getElementById("mySidebar").classList.add("active");
    }

    function closeNav() {
        document.getElementById("mySidebar").classList.remove("active");
    }
</script>

</body>
</html>
