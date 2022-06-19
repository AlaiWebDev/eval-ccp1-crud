<?php
   
    header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type");

    include_once 'config/database.php';
    include_once 'class/utilisateur.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->usrname = $data->usrname;
    $item->username = $data->username;
    $item->email = $data->email;
    $item->phone = $data->phone;
    $item->website = $data->website;
      
    if($item->createUser()){
        echo json_encode("User created.");
    } else{
        echo json_encode("Failed to create user.");
    }
?>