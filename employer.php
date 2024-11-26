<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer</title>
</head>
<body>
    <form action="index.php" method = "Get">
        <button type ="submit">Home</button>
    </form>
    <h1>Community Jobs: Local Employment</h1>
    <h3>Welcome Employers</h3>
    <p>>Post your available job openings here to connect with qualified candidates
    eager to join your team!</p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Job Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Description</th>
            <th>Actions</th>
            <th>Link</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['company_name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['description']; ?></td>

                <td> 
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
                <td>
                    <a href="?id=<?php echo $row['id']; ?>">Apply Now</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>    
    </table>
</body>
</html>
