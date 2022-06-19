<?php
    header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: X-Requested-With,
    //  Content-Type, Origin, Cache-Control, Pragma, Authorization, 
    //  Accept, Accept-Encoding");
    // header("Content-Type: application/json;");
    
    include_once 'config/database.php';
    include_once 'class/utilisateur.php';

    $database = new DB();
    $db = $database->getConnection();

    $items = new User($db);

    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $userArr = array();
       

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "usrname" => $usrname,
                "username" => $username,
                "email" => $email,
                "phone" => $phone,
                "website" => $website,
                "street" => $street,
                "city" => $city,
                "zipcode" => $zipcode,
                "company_name" => $company_name,
                "catch_phrase" => $catch_phrase,
                "business" => $business,
            );

            array_push($userArr, $e);
        }
        echo json_encode($userArr);
    }

?>