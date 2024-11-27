<?php
require_once 'db.php';
require_once 'job.php';
require_once 'employer.php';

$db = new Database();
$action = isset($_GET['action']) ? $_GET['action'] : 'view';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : 'choose';
if ($action === 'choose_type') {
    $type = $_POST['type'];
    header("Location: crud.php?action=add&type=$type");
    exit;
}

//add

//delete

//edit
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listing</title>
</head>
<body>
    <h1>Job Listing</h1>
    <?php if ($action === 'choose_type'): ?>
        <form method="POST" action="crud.php?action=choose_type">
            <label for="type">Select Job Seeker Type:</label>
            <select name="type" id="type">
                <option value="student">Student</option>
                <option value="pwd">PWD (Person with Disability)</option>
            </select>
            <input type="submit" value="Select Type">
        </form>
    <?php elseif ($action === 'add' || $action === 'edit'): ?>
        <form method="POST">
            Job Title: <input type="text" name="job_title" required><br>
            Company Name: <input type="text" name="company_name" required>
            Location: <input type="text" name="location" required><br>
            Description: <textarea name="description" required></textarea><br>
            Link: <textarea name="link" required></textarea><br>
            <input type="submit" value="<?php echo $action === 'add' ? 'Add job' : 'Update Job'; ?>">
        </form>

    <?php else: ?>
        <button id="bottone1" class="a-button" onclick="window.location.href='crud.php?action=choose_type'">
            <strong>Choose Job Seeker Type and Add Job</strong>
        </button>

          
        <table border="1">
                <tr>
                    <th>Job Title</th>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Email</th>
                    <th>Job Seeker Type</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?php echo $job['job_title']; ?></td>
                        <td><?php echo $job['company_name']; ?></td>
                        <td><?php echo $job['location']; ?></td>
                        <td><?php echo $job['description']; ?></td>
                        <td><?php echo $job['email']; ?></td>
                        <td><?php echo isset($job['job_seeker_type']) ? ucfirst($job['job_seeker_type']) : 'N/A'; ?></td>
                        <td>
                            <a href="crud.php?action=edit&id=<?php echo $job['id']; ?>">Edit</a> |
                            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $job['id']; ?>)">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>