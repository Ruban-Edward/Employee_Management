<?php
    namespace App\Model;
    
    class Database{
        protected $conn;

        public function __construct() {
            // Establishes a PDO database connection
            $server = "localhost";
            $user = "root";
            $pass = "";
            $db = "employee";
    
            try {
                $this->conn = new \PDO("mysql:host=$server;dbname=$db", $user, $pass);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die();
            }
        }
    }
?>