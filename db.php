<?php
class Database {

    private $host = 'localhost';
    private $dbname = 'community_jobs';
    private $username = 'root';
    private $password = '';
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return true;  // Return true if the query is successful
        } catch (PDOException $e) {
            // Log the error message without displaying it
            error_log("SQL Error: " . $e->getMessage() . " | Query: $sql | Parameters: " . json_encode($params));
            return false;  // Return false in case of an error
        }
    }

    public function fetchAll($sql) {
        try {
            $stmt = $this->connection->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error without displaying it
            error_log("SQL Error: " . $e->getMessage() . " | Query: $sql");
            return [];  // Return an empty array if there's an error
        }
    }
}
?>