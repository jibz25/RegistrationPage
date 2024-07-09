<?php
// Include your database connection file
include('dconnection.php');

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve username and new password from the form
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that the new password and confirm password match
    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        try {
            // Prepare the SQL statement to update the password
            $stmt = $conn->prepare("UPDATE register_details SET password = ? WHERE username = ?");
            $stmt->bindParam(1, $hashed_password);
            $stmt->bindParam(2, $username);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Password has been successfully reset.";
            } else {
                echo "Error updating password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div>
            <button type="submit" name="submit">Reset Password</button>
        </div>
    </form>
</body>
</html>



