<?php
require_once 'db.php';
require_once 'job.php';
require_once 'Emp.php';

$db = new Database();

$employer = new Employer();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_title'])) {
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $job_seeker_type = $_POST['job_seeker_type'];

    $employer->postJob(db: $db, job_title: $job_title, company_name: $company_name, location: $location, description: $description, email: $email, job_seeker_type: $job_seeker_type);
    echo "Job posted successfully!";
}
?>