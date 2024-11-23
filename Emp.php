<?php
class Employer {
  public function postJob(Database $db, $job_title, $company_name, $location, $description, $link) {
        $job = new Job(0, $job_title, $company_name, $location, $description, $link);
        return $job->save($db);
    }
  public function deleteJob(Database $db, $job_id) {
        $job = new Job($job_id, '', '', '', '', '');
        return $job->delete($db);
    }

}
?>
