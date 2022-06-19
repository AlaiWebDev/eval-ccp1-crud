<?php 
    class DB {
        private $host = "127.0.0.1";
        private $db = "users";
        private $username = "alain";
        private $password = "";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host .
                 ";dbname=" . $this->db, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database not connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>