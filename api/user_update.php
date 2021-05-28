<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/users.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Users($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    // Store values
    if (!empty($data->name)) {
        # code...
    $item->name = $data->name;
    }

    if (!empty($data->email)) {
        # code...
    $item->email = $data->email;
    }
        if (!empty($data->latitude)) {
        # code...
    $item->latitude = $data->latitude;
    }

    if (!empty($data->longitude)) {
        # code...
    $item->longitude = $data->longitude;
    }
    if (!empty($data->role)) {
        # code...
    $item->role = $data->role;

    }
    if($item->updateUsers()){
        echo json_encode("Users data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>