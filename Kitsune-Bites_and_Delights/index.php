
<html>
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

   <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

h3.display-3, h6.display-6 {
    color: #5c5c8a;
    font-weight: bold;
    margin-bottom: 20px;
}

.container-fluid {
    padding-top: 20px;
    margin: auto;
    width: 95%;
}

.table {
    background-color: #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

.table th, .table td {
    padding: 12px;
    border-bottom: 2px solid #f1f1f1;
    text-align: center;
}

.table tr:last-child td {
    border-bottom: none;
}

.btn {
    border: none;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    border-radius: 20px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    cursor: pointer;
}

.btn-success {
    background-color: #ff85a2; /* Same as btn-primary */
}

.btn-success:hover {
    background-color: #ff6384; /* Same hover effect as btn-primary */
    transform: scale(1.05); /* Uniform scaling effect on hover */
}


.btn-primary {
    background-color: #ff85a2;
}

.btn-primary:hover {
    background-color: #ff6384;
    transform: scale(1.05);
}

.btn-danger {
    background-color: #ff7272;
}

.btn-danger:hover {
    background-color: #fa5252;
    transform: scale(1.05);
}

.btn-warning {
    background-color: #ffd43b;
}

.btn-warning:hover {
    background-color: #fcc419;
    transform: scale(1.05);
}

.btn-link {
    background-color: transparent;
    color: #ff85a2;
    padding-left: 0;
    transition: color 0.3s ease;
}

.btn-link:hover {
    color: #ff6384;
    background-color: transparent;
}

.input-group {
    margin-top: 10px;
    margin-bottom: 10px;
}

input[type="number"] {
    width: 60px;
    margin-right: 10px;
    border: 2px solid #ddd;
    border-radius: 10px;
    padding: 8px;
    transition: border-color 0.3s ease;
}

input[type="number"]:focus {
    border-color: #ff85a2;
    outline: none;
}

input[type="file"] {
    border: 2px solid #ddd; /* consistent border styling with number input */
    border-radius: 10px; /* rounded corners */
    padding: 8px 10px; /* padding for better text alignment */
    transition: border-color 0.3s ease, box-shadow 0.3s ease; /* smooth transitions */
    width: auto; /* automatic width based on the parent container */
    display: inline-block; /* to ensure it doesn't stretch fully if not required */
    box-shadow: 0 2px 5px rgba(0,0,0,0.05); 
}

input[type="file"]:hover, input[type="file"]:focus {
    border-color: #ff85a2;
    outline: none;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}


.form-control {
    border-radius: 10px;
    transition: background-color 0.3s ease;
}

.form-control:focus {
    background-color: #fff0f6;
    border-color: #ff85a2;
    outline: none;
}

input[type="text"], input[type="email"], input[type="password"], input[type="search"], input[type="tel"], input[type="url"] {
    border: 2px solid #ddd; /* consistent border styling with number input */
    border-radius: 10px; /* rounded corners */
    padding: 8px 10px; /* padding for better text alignment */
    transition: border-color 0.3s ease, box-shadow 0.3s ease; /* smooth transitions */
    width: auto; /* automatic width based on the parent container */
    display: inline-block; /* to ensure it doesn't stretch fully if not required */
    box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* subtle shadow for depth */
}

input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="url"]:focus {
    border-color: #ff85a2; /* highlight color on focus */
    outline: none; /* removes default focus outline */
    box-shadow: 0 3px 8px rgba(0,0,0,0.1); /* stronger shadow for emphasis when focused */
}

select.form-control {
    border: 2px solid #ddd; /* consistent border styling with other inputs */
    border-radius: 10px; /* rounded corners for a modern look */
    padding: 8px 10px; /* sufficient padding for text alignment and comfort */
    transition: border-color 0.3s ease, box-shadow 0.3s ease; /* smooth visual transitions */
    width: auto; /* adapt width based on parent container */
    display: inline-block; /* avoid full-width stretch unless necessary */
    box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* subtle shadow for depth perception */
    background-color: white; /* ensures the dropdown isn't transparent */
    cursor: pointer; /* indicates that the element is interactive */
}

select.form-control:focus {
    border-color: #ff85a2; /* highlight color when focused */
    outline: none; /* removes default focus outline */
    box-shadow: 0 3px 8px rgba(0,0,0,0.1); /* stronger shadow for emphasis when focused */
    background-color: #fff0f6; /* light pink background on focus for consistency with other inputs */
}

.item-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

.item {
    border: 1px solid #ccc;
    padding: 10px;
    cursor: pointer;
    position: relative;
}

.item-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.item-info {
    text-align: center;
}

.item-details {
    background-color: #f8f8f8;
    padding: 10px;
    border-top: 1px solid #ddd;
}


</style>
<body>
   
   <div class="container-fluid">
       <div class="row bg-warning">
           <div class="col-8">
              <div class="mb-2 mt-2">
               <form action="process_login.php" method="POST">
                  <div class="input-group">
                       <input name="f_username" type="text" class="form-control" placeholder="username">
                       
                       <input name="f_password" type="password" class="form-control" placeholder="password">
                      
                       <input type="submit" value="login" class="btn btn-success">
                       
                       <a href="registration.php" class="btn btn-link">Create Account</a>
                  </div>
                </form>
               </div>
           </div>
       </div>
      
       <div class="row">
           <div class="col-4 bg-success text-light">
             <?php
               if(isset($_GET['deactivate_item'])){
                   $item_id = $_GET['deactivate_item'];
                   $sql_deactivate_item = "UPDATE `items`
                                             SET `item_status`='I'
                                           WHERE `items_id`='$item_id'";
                   mysqli_query($conn, $sql_deactivate_item);
               }
               
               
               if(isset($_GET['update_item'])){
                   $item_id = $_GET['update_item'];
                   
                   $sql_get_item_info = "SELECT * FROM `items`
                                          WHERE items_id = '$item_id'";
                   $result = mysqli_query($conn, $sql_get_item_info);
                   $data_row = mysqli_fetch_assoc($result);
                   ?>    
                   <h3 class="display-6">Update Item Info</h3>
                   <form action="process_new_item.php" method="post" enctype="multipart/form-data">
                        <label for="">Item Name</label>
                        <input type="text" name="f_item_name" class="form-control mb-3">

                        <label for="">Item Description</label>
                        <input type="text" name="f_item_desc" class="form-control mb-3">

                        <label for="">Item Price</label>
                        <input type="text" name="f_item_price" class="form-control mb-3">

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

                        <label for="itemImage">Item Image</label>
                        <input type="file" name="f_item_image" class="form-control mb-3" id="itemImage">

                        <input type="submit" class="btn btn-primary">
                    </form>

                   <?php
               }
               ?>
             
             
             
             <hr>
              <h3 class="display-6">Add New Item</h3>
              
                  <?php 
                      if(isset($_GET['insert_status'])){
                          echo "<div class='alert alert-warning'>";
                              if($_GET['insert_status'] == '1') {
                                  echo "Item Added Successfully.";
                              }
                              else{
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
                        
                        $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' order by items_id DESC";
                        $get_result = mysqli_query($conn, $sql_get_items); ?>
                        <div class="item-container">
                <?php while ($row = mysqli_fetch_assoc($get_result)) { ?>
                    <div class="item" onclick="showDetails(this)">
                        <img src="uploads/<?php echo htmlspecialchars($row['item_image']); ?>" alt="" class="item-image">
                        <div class="item-info">
                            <h4 class="item-name"><?php echo htmlspecialchars($row['item_name']); ?></h4>
                            <p class="item-price"><?php echo "Php " . number_format($row['item_price'], 2); ?></p>
                        </div>
                        <div class="item-details" style="display: none;">
                            <p class="item-category"><?php echo htmlspecialchars($row['item_category']); ?></p>
                            <p class="item-desc"><?php echo htmlspecialchars($row['item_desc']); ?></p>
                            <a href="index.php?update_item=<?php echo $row['items_id']; ?>" class="btn btn-success">Update</a>
                            <a href="index.php?deactivate_item=<?php echo $row['items_id']; ?>" class="btn btn-danger">Deactivate</a>
                        </div>
                    </div>
                <?php } ?>
            </div>


               
           
               
           </div>
       </div>
   </div>
    
</body>
    <script src="js/bootstrap.js"></script>
    <script>
function showDetails(item) {
    var details = item.getElementsByClassName('item-details')[0];
    var isVisible = details.style.display === 'block';
    details.style.display = isVisible ? 'none' : 'block';
}
</script>

</html>