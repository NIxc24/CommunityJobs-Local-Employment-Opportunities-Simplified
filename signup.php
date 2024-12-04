<?php
$servername = "localhost";
$username = "root";        
$password = "";           
$dbname = "community_jobs"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
        exit();
    }

    $email_check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($email_check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already taken. Please use a different email.');</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
        header("Location: login.php");  
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
    <script>

    function validateForm(event) {
            const form = document.forms['signupForm'];
            const fullname = form['fullname'].value.trim();
            const email = form['email'].value.trim();
            const password = form['password'].value;
            const confirmPassword = form['confirm-password'].value;

            if (!fullname) {
                alert('Please fill out the username field.');
                event.preventDefault();
                return false;
            }

            if (!email) {
                alert('Please fill out the email field.');
                event.preventDefault();
                return false;
            }

            if (!password) {
                alert('Please fill out the password field.');
                event.preventDefault();
                return false;
            }

            if (!confirmPassword) {
                alert('Please fill out the confirm password field.');
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="form-container">
        <p class="title">Sign Up</p>

        <form class="form" name="signupForm" method="POST" action="signup.php" onsubmit="return validateForm(event)">
            <div class="input-group">
                <label for="fullname">Username</label>
                <input type="text" name="fullname" id="fullname" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required minlength="6">
            </div>

            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="sign">Sign Up</button>
        </form>

        <p class="login">Already have an account? 
            <a rel="noopener noreferrer" href="login.php">Log in</a>
        </p>
    </div>
</body>
</html>