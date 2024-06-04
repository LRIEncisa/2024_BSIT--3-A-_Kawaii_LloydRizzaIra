<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        .btn {
            border: none;
            color: rgb(255, 255, 255);
            background-color: rgb(240, 128, 128);
            padding: 10px 15px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
            font-size: 20px;
        }

        #bgimg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/kbdbg.jpg');
            background-size: cover;
            background-attachment: scroll;
            z-index: -1;
        }

        .btn-success {
            background-color: #ff85a2;
            /* Same as btn-primary */
        }

        .btn-success:hover {
            background-color: #ff6384;
            /* Same hover effect as btn-primary */
            transform: scale(1.05);
            /* Uniform scaling effect on hover */
        }

        .btn-link {
            background-color: transparent;
            color: #ff85a2;
            padding-left: 0;
            transition: color 0.3s ease;
        }

        .btn-outline-success {
            background-color: transparent;
            color: #ff85a2;
            padding-left: 0;
            transition: color 0.3s ease;
            margin-left: 125px;
            /* Center the text horizontally */
        }

        .btn-link:hover {
            color: #ff6384;
            background-color: transparent;
        }

        .input-group {
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;/* Center text horizontally */
        }

        input[type="text"],
        input[type="password"] {
            width: 300px;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 8px 10px;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        input[type="text"],
        input[type="password"] {
            border-color: #ff85a2;
            outline: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 15px;
            width: 60px;
            font-size: 18px;
        }

        .form-control:focus {
            background-color: #fff0f6;
            border-color: #ff85a2;
            outline: none;
        }

        select.form-control {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 8px 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: auto;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            background-color: white;
            cursor: pointer;
        }

        select.form-control:focus {
            border-color: #ff85a2;
            outline: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff0f6;
        }

        .container {
            max-width: 400px;
            /* Smaller width for compactness */
            margin-left: 11%;
        }

        .login-container {
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            /* Reduced padding for compactness */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            margin-top: 40%;
            /* Reduced margin */
        }

        h2 {
            text-align: center;
            font-size: 40px;
        }
    </style>
</head>

<body>

    <div id="bgimg">
        <div class="container">
            <div class="login-container" id="loginContainer">
                <h2>Login</h2>
                <form action="process_login.php" method="POST">
                    <div class="input-group">
                        <input name="f_username" type="text" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <input name="f_password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Login" class="btn">
                    </div>
                    <a href="registration.php" class="btn-outline-success">Create Account</a>
                </form>
            </div>
        </div>

    </div>
    <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            var loginContainer = document.getElementById('loginContainer');
            if (loginContainer.style.display === 'none' || loginContainer.style.display === '') {
                loginContainer.style.display = 'block';
            } else {
                loginContainer.style.display = 'none';
            }
        });
    </script>

</body>

</html>