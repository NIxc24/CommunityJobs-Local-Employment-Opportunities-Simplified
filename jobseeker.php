<?php
require_once 'db.php';
require_once 'job.php';

$db = new Database();

$sql = "SELECT * FROM jobs";
$jobs = $db->fetchAll($sql);

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
    <h1>Available Jobs</h1>
    <table border = "1">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Email</th>
                <th>Apply</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($job['company_name']); ?></td>
                        <td><?php echo htmlspecialchars($job['location']); ?></td>
                        <td><?php echo htmlspecialchars($job['description']); ?></td>
                        <td><?php echo htmlspecialchars($job['email']); ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="job_id" value="<?php echo $job['id'];?>">
                                Name: <input type="text" name="name" required><br>
                                Email: <input type="email" name="email" required>
                                <input type="submit" value="Apply for Job">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No jobs available at the moment.</td>
                </tr> 
            <?php endif; ?>           
        </tbody>
    </table><br><br>
    <form action="home.php" method="POST">
        <button type="submit" name="user_type" value="home" class="button">HOME</button>
    </form>
</body>
</html> 