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
    <link rel="stylesheet" href="crud.css">
    <title>Employer</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<input type="checkbox" id="sidebar-toggle" class="toggle-sidebar">
<label for="sidebar-toggle" class="hamburger-menu">&#9776;</label>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
    </div>
    <ul class="sidebar-menu">
        <!-- Home Button -->
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
            <a href="about.php" class="bookmarkBtn">
                <span class="IconContainer">
                    <svg viewBox="0 0 448 512" height="0.9em" class="icon">
                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0 32c-61.6 0-192 30.8-192 92.3V448h384v-37.7c0-61.5-130.4-92.3-192-92.3z"></path>
                    </svg>
                </span>
                <p class="text">About Us</p>
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
            <a href="login.html" class="bookmarkBtn">
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

<div class="content-container">
    <h1>Job Listings</h1>

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
            <input type="text" name="job_title" placeholder="Job Title" required>
            <input type="text" name="company_name" placeholder="Company Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <textarea name="description" placeholder="Job Description" required></textarea>
            <input type="email" name="email" placeholder="Email" required>
            <select name="job_seeker_type" required>
                <option value="student">Student</option>
                <option value="pwd">PWD</option>
                <option value="jobseeker">Job Seeker</option>
            </select>
            <div class="button-wrapper">
                <div class="button-container">
                    <form action="post_job.php" method="POST">
                        <button type="submit" class="button post-job">Post Job</button>
                    </form>
                </div>
                <div class="button-container">
                    <form action="crud.php" method="POST">
                        <button type="submit" name="user_type" value="home" class="button">Back to Job Listing</button>
                    </form>
                </div>
            </div>
        </form>

    <?php else: ?>
        <button id="bottone1" class="a-button" onclick="window.location.href='crud.php?action=choose_type'">
            <span class="button__text">Add Job</span>
            <span class="button__icon">
                <svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <line x1="12" x2="12" y1="5" y2="19"></line>
                    <line x1="5" x2="19" y1="12" y2="12"></line>
                </svg>
            </span>
        </button>

        <div class="table-container">
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
    </table>
</div>
    <?php endif; ?>
</div>

<script>
function confirmDelete(jobId) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`crud.php?action=delete&id=${jobId}`, {
        method: 'GET'
      })
      .then(response => response.text())
      .then(data => {
        if (data.includes("success")) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "Failed to delete. Please try again.",
            icon: "error"
          });
        }
      })
      .catch((error) => {
        Swal.fire({
          title: "Error!",
          text: "An error occurred. Please try again.",
          icon: "error"
        });
        console.error('Error:', error);
      });
    }
  });
}
</script>
</body>
</html>