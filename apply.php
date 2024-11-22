<?php
require_once 'db.php';        
require_once 'JobSeeker.php'; 

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);
?>
