<?php
    class User{

        // conn
        private $conn;

        // table
        private $dbTable = "utilisateurs";

        // col
        public $id;
        public $usrname;
        public $username;
        public $email;
        public $phone;
        public $website;
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        public function getUsers(){
            $sqlQuery = "SELECT id, usrname, username, email, phone, website
               FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE User
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    usrname = :usrname, 
                    username = :username, 
                    email = :email,
                    phone = :phone,
                    website = :website";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->usrname=htmlspecialchars(strip_tags($this->usrname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->website=htmlspecialchars(strip_tags($this->website));
                   
            // bind data
            $stmt->bindParam(":usrname", $this->usrname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":website", $this->website);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

       // GET User
       public function getSingleUser(){
        $sqlQuery = "SELECT
                    id, 
                    usrname, 
                    username, 
                    email,
                    phone,
                    website
                  FROM
                    ". $this->dbTable ."
                WHERE 
                   id = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->usrname = $dataRow['usrname'];
        $this->username = $dataRow['username'];
        $this->email = $dataRow['email'];
        $this->phone = $dataRow['phone'];
        $this->website = $dataRow['website'];
      
    }      
        

        // UPDATE User
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    usrname = :usrname, 
                    username = :username, 
                    email = :email,
                    phone = :phone,
                    website = :website
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->usrname=htmlspecialchars(strip_tags($this->usrname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->website=htmlspecialchars(strip_tags($this->website));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":usrname", $this->usrname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":website", $this->website);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE User
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
