<?php
include("dconnection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if username already exists
    $check_query = mysqli_query($con, "SELECT * FROM register_details WHERE Username='$username'");
    if (mysqli_num_rows($check_query) > 0) {
        echo "<script>alert('Username already exists. Please choose another username.');</script>";
    } else {
        // Check if passwords match
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($con, "INSERT INTO register_details (Username, Password) VALUES ('$username', '$password')");
            if ($query) {
                echo "<script>alert('Registration successful. Welcome to our gym!');window.location='login.php';</script>";
            } else {
                echo "<script>alert('There was an error. Please try again later.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff; /* White background */
        }
        
        .container {
            display: flex;
            width: 80%;
            height: 80%;
            background-color: #fff; /* White container background */
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3); /* Shadow effect */
            overflow: hidden;
            position: relative; /* Ensure positioning context for the overlay */
        }
        
        .left-side {
            flex: 0.5;
            padding: 30px;
            color: #000; /* Black text color */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* Center contents horizontally */
        }
        
        .right-side {
            flex: 1;
            background-color: #ff0; /* Yellow background for image slider */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Hide overflow content */
            position: relative; /* Ensure positioning context for the overlay */
        }
        
        .slider-container {
            width: auto; /* Auto width */
            height: 80%; /* Adjust height of slider container */
            max-height: 100%; /* Maximum height */
            overflow: hidden;
        }
        
        .slider {
            display: flex;
            flex-direction: column; /* Stack slides vertically */
            transition: transform 0.5s ease;
        }
        
        .slide {
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: none;
        }
        
        .slide.active {
            display: flex; /* Show active slide */
            align-items: center; /* Center image vertically */
            justify-content: center; /* Center image horizontally */
        }
        
        .slide img {
            max-width: 200%;
            max-height: 200%;
            object-fit: contain; /* Fit the image within its container */
        }
        
        .form-control {
            margin-bottom: 20px;
            width: 95%;
            padding: 10px;
            border: 1px solid #000; /* Black border */
            border-radius: 5px;
            box-sizing: border-box;
            background-color: transparent; /* Transparent input background */
            color: #000; /* Black text color */
        }
        
        .form-control:focus {
            outline: none;
            border-color: #ff0; /* Yellow border on focus */
        }
        
        .btn {
            background-color: #FFD600; /* Yellow button background */
            color: #000; /* Black button text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #789; /* Light gray background on hover */
            color: #000; /* Black text color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="gymlogo.png" alt="Logo" style="width: 200px; height: 200px; margin-bottom: 20px;">
            <h2>Sign Up</h2>
            <form action="" method="POST">
                <div>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <button href="login.php" type="submit" name="submit" class="btn">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
        <div class="right-side">
            <div class="slider-container">
                <div class="slider">
                    <div class="slide active">
                        <img src="gym.png" alt="Image 1">
                    </div>
                    <div class="slide">
                        <img src="gym6.jpg" alt="Image 2">
                    </div>
                    <div class="slide">
                        <img src="gym7.jpg" alt="Image 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript or jQuery code for the slider
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.querySelectorAll('.slide');
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }
            slides.forEach(slide => {
                slide.classList.remove('active');
            });
            slides[slideIndex].classList.add('active');
            slideIndex++;
            setTimeout(showSlides, 2000); // Change slide every 2 seconds
        }
    </script>
</body>
</html>











