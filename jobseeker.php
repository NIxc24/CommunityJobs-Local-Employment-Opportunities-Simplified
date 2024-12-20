<?php
require_once 'db.php';
require_once 'job.php';

$db = new Database();

$sql = "SELECT * FROM jobs";
$jobs = $db->fetchAll($sql);
if ($jobs === false) {
    die("Error: Could not fetch jobs.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jobseeker.css">
    <title>Job Seeker - Available Jobs and Apply</title>
</head>
<body>

<input type="checkbox" id="sidebar-toggle" class="toggle-sidebar">
<label for="sidebar-toggle" class="hamburger-menu">&#9776;</label>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="home.php" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg viewBox="0 0 512 512" height="0.9em" class="icon">
                        <path d="M256 0L0 192h96v320h128V320h64v192h128V192h96L256 0z"></path>
                    </svg>
                </span>
                <p class="text">Home</p>
            </a>
        </li>
        
        <li>
            <a href="about.html" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg viewBox="0 0 448 512" height="0.9em" class="icon">
                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0 32c-61.6 0-192 30.8-192 92.3V448h384v-37.7c0-61.5-130.4-92.3-192-92.3z"></path>
                    </svg>
                </span>
                <p class="text">About</p>
            </a>
        </li>
        <li>
            <a href="contact.php" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg viewBox="0 0 512 512" height="0.9em" class="icon">
                        <path d="M502.3 190.8L315.4 3.8c-12.5-12.5-32.8-12.5-45.3 0l-23.9 23.9c-12.5 12.5-12.5 32.8 0 45.3l93.2 93.2c-13.5 7.9-26.5 16.3-39.3 24.7-15.7 10.5-31.6 21.8-47.1 33.6-23.1 17.1-45.4 35.3-67.1 54.6-25.1 22.1-49.7 44.5-72.2 68.4-13.2 14.1-26.7 28.9-39.2 44.4l8.7 28.1c10.5 33.4 45.1 52.9 79.9 47.6 32.9-4.4 58.9-29.5 66.3-62.5 5.4-19.6 9.5-40.4 12.3-61.5 15.9 4.1 31.9 8.4 47.9 12.7 32.9 8.8 60.7 22.3 87.5 41.8l17.1-17.1c12.5-12.5 12.5-32.8-.1-45.3z"></path>
                    </svg>
                </span>
                <p class="text">Contact Us</p>
            </a>
        </li>

        <li>
            <a href="login.php" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg viewBox="0 0 512 512" height="0.9em" class="icon">
                        <path d="M240 64C240 28.7 211.3 0 176 0C140.7 0 112 28.7 112 64C112 99.3 140.7 128 176 128C211.3 128 240 99.3 240 64zM352 64C352 28.7 323.3 0 288 0C252.7 0 224 28.7 224 64C224 99.3 252.7 128 288 128C323.3 128 352 99.3 352 64zM456 32H56C39.3 32 24 47.3 24 64V448C24 464.7 39.3 480 56 480H456C472.7 480 488 464.7 488 448V64C488 47.3 472.7 32 456 32z"></path>
                    </svg>
                </span>
                <p class="text">Logout</p>
            </a>
        </li>
    </ul>
</div>

    <h1>Available Jobs</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Email</th>
                <th>Jobseeker Type</th>
                <th>Apply</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($job['job_title'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($job['company_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($job['location'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($job['description'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($job['email'] ?? 'N/A'); ?></td>
                    <td><?php echo isset($job['job_seeker_type']) ? ucfirst($job['job_seeker_type']) : 'N/A'; ?></td>
                    <td>
                        <?php 
                                $jobTitle = htmlspecialchars($job['job_title'] ?? 'N/A');
                                $employerEmail = htmlspecialchars($job['email'] ?? 'N/A');
                                $subject = urlencode("Application for $jobTitle");
                                $body = urlencode("Instructions:\nEnter your name and attach your resume file here if you're interested in Applying for $jobTitle.");
                                $gmailLink = "https://mail.google.com/mail/?view=cm&fs=1&to=$employerEmail&su=$subject&body=$body";
                            ?>
                            <a href="<?php echo $gmailLink; ?>" target="_blank" class="apply-button">Apply Now</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No jobs available at the moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table><br><br><br>
</body>
</html>
