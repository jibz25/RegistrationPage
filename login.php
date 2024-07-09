<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        // Establish database connection
        $con = mysqli_connect("localhost", "root", "", "databasegym");

        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get username and password from form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to fetch hashed password from database based on username
        $query = "SELECT password FROM register_details WHERE username=?";
        
        // Prepare statement
        $stmt = mysqli_prepare($con, $query);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Execute statement
        mysqli_stmt_execute($stmt);
        
        // Bind result variables
        mysqli_stmt_bind_result($stmt, $hashed_password);
        
        // Fetch value
        mysqli_stmt_fetch($stmt);
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            echo "<script>alert('Login successful');</script>";
            // Redirect to dashboard or home page
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($con);
    }
    ?>
</body>
</html>




