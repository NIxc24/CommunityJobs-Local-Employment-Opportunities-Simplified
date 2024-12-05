<?php
class Employer {
    public function postJob(Database $db, $job_title, $company_name, $location, $description, $email, $job_seeker_type) {
        $sql = "SELECT COUNT(*) FROM jobs WHERE job_title = :job_title AND company_name = :company_name AND location = :location";
        $params = [
            ':job_title' => $job_title,
            ':company_name' => $company_name,
            ':location' => $location
        ];
        $existingJobCount = $db->fetchColumn($sql, $params);
        if ($existingJobCount == 0) {
            $job = new Job(0, $job_title, $company_name, $location, $description, $email, $job_seeker_type);
            return $job->save($db);
        } else {
            return false;
        }
    }    
    public function deleteJob(Database $db, $job_id) {
        $job = new Job($job_id, '', '', '', '', '', '');
        return $job->delete($db);
    }
  
    public function editJob(Database $db, $job_id, $job_title, $company_name, $location, $description, $email, $job_seeker_type) {
        $job = new Job($job_id, $job_title, $company_name, $location, $description, $email, $job_seeker_type);
        return $job->update($db);
    }
}
?>