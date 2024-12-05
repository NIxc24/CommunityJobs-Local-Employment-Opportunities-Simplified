<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <h1>Welcome to Our Job Board</h1>
        <div class="button-container">
            <form action="crud.php" method="POST">
                <button type="submit" name="user_type" value="employer" class="button">Employer</button>
            </form>
        
            <form action="jobseeker.php" method="POST">
                <button type="submit" name="user_type" value="jobseeker" class="button">Job Seeker</button>
            </form>
        </div>
    </div>
</body>
</html>