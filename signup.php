<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="signup.css">
        <title>Sign Up</title>
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