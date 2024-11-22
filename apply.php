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
</body>
</html>
    
