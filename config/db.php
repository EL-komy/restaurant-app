
<?php
class Database {
    private $host = "localhost";
    private $db_name = "fryco";
    private $username = "mk";
    private $password = "221999@mk";
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Database connection error: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
?>
