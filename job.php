<?php
class Job {
    
    private $id;
    private $job_title;
    private $company_name;
    private $location;
    private $description;
    private $email;
    private $job_seeker_type;

    public function __construct($id, $job_title, $company_name, $location, $description, $email, $job_seeker_type) {
        $this->id = $id;
        $this->job_title = $job_title;
        $this->company_name = $company_name;
        $this->location = $location;
        $this->description = $description;
        $this->email = $email;
        $this->job_seeker_type = $job_seeker_type;
    }

    public function save(Database $db) {
        if (empty($this->job_seeker_type)) {
            return false;
        }
    
        $query = "INSERT INTO jobs (job_title, company_name, location, description, email, job_seeker_type) 
                  VALUES (:job_title, :company_name, :location, :description, :email, :job_seeker_type)";
        $stmt = $db->getConnection()->prepare($query);
        $stmt->bindParam(':job_title', $this->job_title);
        $stmt->bindParam(':company_name', $this->company_name);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':job_seeker_type', $this->job_seeker_type);
        return $stmt->execute();
    }

    public function delete(Database $db) {
        $sql = "DELETE FROM jobs WHERE id = :id";
        $params = [':id' => $this->id];
        return $db->query($sql, $params);
    }

    public function update(Database $db) {
        $sql = "UPDATE jobs SET job_title = :job_title, company_name = :company_name, 
                location = :location, description = :description, email = :email, job_seeker_type = :job_seeker_type
                WHERE id = :id";
        $params = [
            ':id' => $this->id,
            ':job_title' => $this->job_title,
            ':company_name' => $this->company_name,
            ':location' => $this->location,
            ':description' => $this->description,
            ':email' => $this->email,
            ':job_seeker_type' => $this->job_seeker_type
        ];
        return $db->query($sql, $params);
    }

    public static function fetchAll(Database $db) {
        $sql = "SELECT * FROM jobs";
        return $db->fetchAll($sql);
    }
}
?>
