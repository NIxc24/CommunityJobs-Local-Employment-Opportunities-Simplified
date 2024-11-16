<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listing</title>
</head>
<body>
    <h1>Job Listing</h1>

<?php if ($action === 'add' || $action === 'edit'); ?>
    <form method="POST">
        Job Title: <input type="text" name="job_title" required><br>
        Company Name: <input type="text" name="company_name" required>
        Location: <input type="text" name="location" required><br>
        Description: <textarea name="description" required></textarea><br>
        Link: <textarea name="link" required></textarea><br>
        <input type="submit" value="<?php echo $action === 'add' ? 'Add job' : 'Update Job'; ?>">
    </form>

    
</body>
</html>