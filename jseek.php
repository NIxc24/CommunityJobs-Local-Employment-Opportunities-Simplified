<?php
class JobSeeker {
    
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function applyForJob(Database $db, $job_id) {
        if ($job_id <= 0) {
            echo "Invalid job ID: " . $job_id;
            return false;
        }
    
        $sql = "INSERT INTO applications (job_id, name, email) VALUES (:job_id, :name, :email)";
        
        $params = [
            ':job_id' => $job_id,
            ':name' => $this->name,
            ':email' => $this->email
        ];
    
        echo "SQL: " . $sql . "<br>";
    
        return $db->query($sql, $params);
    }
    
}
?>