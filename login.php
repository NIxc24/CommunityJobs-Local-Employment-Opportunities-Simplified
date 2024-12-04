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
                    <div class="forgot">
                        <a rel="noopener noreferrer" href="#">Forgot Password?</a>
                    </div>
                </div>
                <button type="submit" class="sign">Sign In</button>
            </form>

            <p class="signup">Don't have an account?
                <a rel="noopener noreferrer" href="signup.php" class="">Sign up</a>
            </p>
        </div>
    </body>
</html>