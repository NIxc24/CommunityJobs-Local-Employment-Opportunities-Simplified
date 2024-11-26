<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>
<body>
    <div class="container">
        <h1>Welcome to Our Job Board</h1>
        <form action="employer.php" method="POST">
            <button type="submit" name="user_type" value="employer" class="button">Employer</button>
        </form><br>
        <form action="jseeker.php" method="POST">
            <button type="submit" name="user_type" value="jobseeker" class="button">Job Seeker</button>
        </form>
    </div>
</body>
</html>
