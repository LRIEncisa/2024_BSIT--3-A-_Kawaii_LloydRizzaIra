<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .form-container {
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px; /* Reduced padding for compactness */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
            margin-top: 40px; /* Reduced margin */
            margin-bottom: 40px;
        }

        h3.display-4 {
            color: #5c5c8a;
            font-weight: bold;
            margin-bottom: 20px; /* Reduced space below the title */
            font-size: 1.5rem; /* Smaller font size */
        }

        .container {
            max-width: 400px; /* Smaller width for compactness */
            margin: auto;
        }

        .btn-custom, .btn-link-custom {
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom {
            background-color: #ff85a2;
            color: white;
            padding: 8px 16px; /* Slightly smaller padding */
        }

        .btn-custom:hover {
            background-color: #ff6384;
            transform: scale(1.08);
        }

        .btn-link-custom {
            background-color: transparent;
            color: #ff85a2;
        }

        .btn-link-custom:hover {
            color: #ff6384;
            text-decoration: underline;
        }

        .form-control {
            border-radius: 15px;
        }

        .form-control:focus {
            background-color: #fff0f6;
            border-color: #ff85a2;
            box-shadow: 0 3px 12px rgba(255,133,162,0.25);
        }
    </style>
</head>
<body>
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
</body>
</html>
