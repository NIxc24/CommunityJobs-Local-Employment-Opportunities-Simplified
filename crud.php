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

if ($action === 'add') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $email = $_POST['email'];
        $job_seeker_type = $_POST['job_seeker_type'];
        if (empty($job_seeker_type)) {
            echo "Job seeker type is required.";
            exit;
        }
        switch ($job_seeker_type) {
            case 'student':
                $job = new Job(0, $job_title, $company_name, $location, $description, $email, 'student');
                break;
            case 'pwd':
                $job = new Job(0, $job_title, $company_name, $location, $description, $email, 'pwd');
                break;
            default:
                $job = new Job(0, $job_title, $company_name, $location, $description, $email, 'jobseeker');
                break;
        }
        if ($job->save($db)) {
            echo "Job posted successfully!";
        } else {
            echo "Failed to post job. Please try again.";
        }
        header("Location: crud.php");
        exit;
    }
}

if ($action === 'delete') {
    $job = new Job($id, '', '', '', '', '', '');
    $job->delete($db);
    header("Location: crud.php");
    exit;
}

if ($action === 'edit') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $email = $_POST['email'];
        $job_seeker_type = $_POST['job_seeker_type'];
        $job = new Job($id, $job_title, $company_name, $location, $description, $email, $job_seeker_type);
        $job->update($db);
        header("Location: crud.php");
        exit;
    }
    $job = new Job($id, '', '', '', '', '', '');
}

$jobs = Job::fetchAll($db);
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