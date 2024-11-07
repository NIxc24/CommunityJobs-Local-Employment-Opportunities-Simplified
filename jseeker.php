<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker</title>
</head>
<body>
<form action="index.php" method = "Get">
        <button type ="submit">Home</button>
    </form>
    <h1>Community Jobs: Local Employment</h1>
    <h3>Welcome, Job Seeker</h3>
    <p>Here you can browse job listings and apply for jobs.</p>
    <a href="create.php">Add New Job </a><br>
    
    <?php
        include 'config.php'; // Include the database connection
        // Fetch all available jobs from the database
        $sql = "SELECT * FROM jobs";
        $result = $conn->query($sql);
    ?>
            <h1>Community Jobs: Local Employment</h1>
            <!-- Checkbox to trigger modal -->
        <label for="viewJobsCheck" style="cursor: pointer;">View Available Jobs</label>
        <!-- The Modal -->
        <div class="modal">
        <div class="modal-content">

            <h2>Available Jobs</h2>

        <?php if ($result->num_rows > 0): ?>
            
            <table border = 1>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Link</th>
                </tr>
        
                <?php while ($row = $result->fetch_assoc()) : ?>
                
                <tr>
                    <td><?php echo $row['job_title']; ?></td>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td> 
                        <a href=" ?id=<?php echo $row['id'];?>">Apply Now</a>
                    </td>
                </tr>
            
                <?php endwhile; ?>
            </table>

                <?php else: ?>
                    <p>No jobs available at the moment.</p>
                <?php endif; ?>
        </div>
    </div>
</body>
</html>