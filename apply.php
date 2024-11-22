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
