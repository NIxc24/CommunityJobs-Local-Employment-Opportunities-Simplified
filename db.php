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
            return $stmt;
        } catch (PDOException $e) {
            error_log("SQL Error: " . $e->getMessage() . " | Query: $sql | Parameters: " . json_encode($params));
            return false;
        }
    }
  
    public function fetchColumn($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("SQL Error: " . $e->getMessage() . " | Query: $sql");
            return false;
        }
    }
  
    public function fetchAll($sql) {
        try {
            $stmt = $this->connection->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("SQL Error: " . $e->getMessage() . " | Query: $sql");
            return [];
        }
    }
}
?>