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
    $item->street = $data->street;
    $item->city = $data->city;
    $item->zipcode = $data->zipcode;
    $item->company_name = $data->company_name;
    $item->catch_phrase = $data->catch_phrase;
    $item->business = $data->business;
      
    if($item->createUser()){
        // $id = $db->lastInsertId();
        echo json_encode($id);// permet d'envoyer l'ID qui a été ajouté en auto-increment pour plus tard implémenter les adresses et compagnies
    } else{
        echo json_encode("Failed to create user.");
    }
?>