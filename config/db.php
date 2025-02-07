<?php
class Database {
    public $dataIfo = 'mysql:dbname=fryco;host=localhost;port=3306';
    public $user = 'mk';
    public $password = '221999@mk';//221999@mk
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO($this->dataIfo, $this->user, $this->password);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}
