<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registration.css">
    <style>
        
        #bgimg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height:100%;
        background-image: url('img/kbdbg.jpg');
        background-size: cover;
        background-attachment: scroll;
        z-index: -1;
    }

        
    </style>
</head>
<body> 
    <div id="bgimg">
    <div class="container">
        <div class="form-container">
            <h3 class="display-4 text-center">Registration Form</h3>
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>
            <form action="process_registration.php" method="POST">
                <div class="form-group">
                    <label for="r_fullname">Fullname</label>
                    <input type="text" class="form-control" id="r_fullname" name="r_fullname" required>
                </div>
                <div class="form-group">
                    <label for="r_username">Username</label>
                    <input type="text" class="form-control" id="r_username" name="r_username" required>
                </div>
                <div class="form-group">
                    <label for="r_password">Password</label>
                    <input type="password" class="form-control" id="r_password" name="r_password" required>
                </div>
                <div class="form-group">
                    <label for="r_conf_password">Confirm Password</label>
                    <input type="password" class="form-control" id="r_conf_password" name="r_conf_password" required>
                </div>
                <div class="form-group">
                    <label for="r_address">Address</label>
                    <input type="text" class="form-control" id="r_address" name="r_address">
                </div>
                <div class="form-group">
                    <label for="r_contact">Contact</label>
                    <input type="text" class="form-control" id="r_contact" name="r_contact">
                </div>
                <div class="form-group">
                    <label for="r_gender">Birth Certified Gender</label>
                    <select class="form-control" id="r_gender" name="r_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="X">Rather Not Say</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Register</button>
                    <a href="index.php" class="btn btn-link-custom">Login</a>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
