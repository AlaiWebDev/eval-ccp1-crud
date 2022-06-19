<?php
    class User{

        // conn
        private $conn;

        // table
        private $dbTable = "utilisateurs";
        private $dbTableAddress = "address";
        private $dbTableCompany = "company";

        // col
        public $id;
        public $usrname;
        public $username;
        public $email;
        public $phone;
        public $website;
        public $street;
        public $city;
        public $zipcode;
        public $company_name;
        public $catch_phrase;
        public $business;
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        // public function getUsers(){
        //     $sqlQuery = "SELECT id, usrname, username, email, phone, website
        //        FROM " . $this->dbTable . "";
        //     $stmt = $this->conn->prepare($sqlQuery);
        //     $stmt->execute();
        //     return $stmt;
        // }
        public function getUsers(){
            $sqlQuery = "SELECT *
               FROM " . $this->dbTable . " JOIN " . $this->dbTableCompany . " ON id_user_company = id JOIN " . $this->dbTableAddress . " ON id_user_address = id";
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
            
            $stmt->execute();
            $id_user = $this->conn->lastInsertId();
            $id_user = intval($id_user);
            $sqlQuery = "INSERT INTO
                        ". $this->dbTableAddress ."
                    SET
                    id_user_address = :id_user_address
                    street = :street, 
                    city = :city, 
                    zipcode = :zipcode";
        
            $stmt = $this->conn->prepare($sqlQuery);
            
            // sanitize
            $this->street=htmlspecialchars(strip_tags($this->street));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->zipcode=htmlspecialchars(strip_tags($this->zipcode));
                   
            // bind data
            $stmt->bindParam(":id_user_address", $this->id);
            $stmt->bindParam(":street", $this->street);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":zipcode", $this->zipcode);
            $stmt->execute();

            $sqlQuery = "INSERT INTO
                        ". $this->dbTableCompany ."
                    SET
                    id_user_company = :id_user_company
                    company_name = :company_name, 
                    catch_phrase = :catch_phrase, 
                    business = :business";
        
            $stmt = $this->conn->prepare($sqlQuery);
            
            // sanitize
            $this->company_name=htmlspecialchars(strip_tags($this->company_name));
            $this->catch_phrase=htmlspecialchars(strip_tags($this->catch_phrase));
            $this->business=htmlspecialchars(strip_tags($this->business));
                   
            // bind data
            $stmt->bindParam(":id_user_company", $this->id);
            $stmt->bindParam(":company_name", $this->company_name);
            $stmt->bindParam(":catch_phrase", $this->catch_phrase);
            $stmt->bindParam(":business", $this->business);
            
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
        
        $sqlQuery = "SELECT 
                    street, 
                    city, 
                    zipcode
                  FROM
                    ". $this->dbTableAddress ."
                WHERE 
                   id_user_address = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->street = $dataRow['street'];
        $this->city = $dataRow['city'];
        $this->zipcode = $dataRow['zipcode'];

        $sqlQuery = "SELECT 
                    company_name, 
                    catch_phrase, 
                    business
                  FROM
                    ". $this->dbTableCompany ."
                WHERE 
                   id_user_company = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->company_name = $dataRow['company_name'];
        $this->catch_phrase = $dataRow['catch_phrase'];
        $this->business = $dataRow['business'];
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
