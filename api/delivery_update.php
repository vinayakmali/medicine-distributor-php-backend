<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            header("Access-Control-Allow-Headers: *");

    include_once '../config/database.php';
    include_once '../class/delivery.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Delivery($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->del_id = $data->id;
    
    // Delivery values
    $item->returnedTarget = $data->return_count;
    
    if($item->updateDelivery()){
        echo json_encode("Delivery data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>