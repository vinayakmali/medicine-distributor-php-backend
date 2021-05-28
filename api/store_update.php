<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/store.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Store($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->store_id = $data->id;
    
    // Store values
    if (!empty($data->name)) {
        # code...
    $item->name = $data->name;
    }

    if (!empty($data->location)) {
        # code...
    $item->location = $data->location;
    }
    
    if($item->updateStore()){
        echo json_encode("Store data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>