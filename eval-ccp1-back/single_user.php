<?php
    header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: X-Requested-With, 
    // Content-Type, Origin, Cache-Control, Pragma, Authorization, 
    // Accept, Accept-Encoding");
    // header("Content-Type: application/json;");
    
    include_once 'config/database.php';
    include_once 'class/utilisateur.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new User($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleUser();

    if($item != null){
        $user_Arr = array(
            "id" =>  $item->id,
            "usrname" => $item->usrname,
            "username" => $item->username,
            "email" => $item->email,
            "phone" => $item->phone,
            "website" => $item->website
        );
      
        http_response_code(200);
        echo json_encode($user_Arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("User record not found.");
    }
?>