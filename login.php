<?php
$servername = "localhost";
$username = "root";        
$password = "";           
$dbname = "community_jobs"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];  
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: home.php"); 
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
} else {
    echo "Please submit the login form.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <title>Login</title>
    </head>
    <body>
        <div class="form-container">
            <p class="title">Login</p>

            <form class="form" method="POST" action="login.php">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
            
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="sign">Sign In</button>
            </form>

            <p class="signup">Don't have an account?
                <a rel="noopener noreferrer" href="signup.php" class="">Sign up</a>
            </p>
        </div>
    </body>
</html>