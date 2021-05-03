<?php
// use PDO;
// use PDOException;
/**
 * Database class
 */
class Database
{
    private $host = "localhost";
    private $db_name = "todo_list";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET CHARACTER SET utf8");
            //echo "Database connected!!!";
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
