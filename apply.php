<?php
require_once 'db.php';        
require_once 'JobSeeker.php'; 

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $job_seeker = new JobSeeker($name, $email);
  
    $db = new Database();
  
    $job_seeker->applyForJob($db, $job_id);
  
    $message = "Your application has been submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Jobs</title>
</head> 

<body>
    <h1>Apply for a Job</h1> 
    <!-- Display available jobs -->
    <h2>Available Jobs</h2>
    
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <!-- Application Form -->
        <form action="apply.php" method="POST">
            <label for="job">Job:</label><br>
            <select id="job_id" name="job_id" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['job_title']; ?> at <?php echo $row['company_name']; ?> (<?php echo $row['location']; ?>)
                    </option>
                <?php endwhile; ?>
            </select><br><br>
            
            <label for="name">Your Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Your Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <input type="submit" value="Apply Now">
        </form>
    <?php else: ?>
        <p>No jobs available at the moment.</p>
    <?php endif; ?>

     <br>
    <a href="employer.php">Back to Job Listings</a>
</body>
</html>
    
