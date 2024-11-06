<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board Home</title>
 
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Job Board</h1>
        <form action="index.php" method="POST">
            <button type="submit" name="user_type" value="employer" class="button">Employer</button>
        </form><br>
        <form action="redirect.php" method="POST">
            <button type="submit" name="user_type" value="jobseeker" class="button">Job Seeker</button>
        </form>
    </div>
</body>
</html>
