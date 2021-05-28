<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/delivery.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Delivery($db);

    $data = json_decode(file_get_contents("php://input"));
    $item->user_id = $data->user;
    $item->med_id = $data->Medicine;
    $item->store_id = $data->Store;
    $item->quantity = $data->deliver_count;
    
    if ($item->checkDeliveryExist() == '') {
        # code...
    if($item->createDelivery()){
        $returnData = [
        'success' => 1,
        'message' => 'Delivery created successfully.'
        ];
    } else{
        $returnData = [
        'success' => 0,
        'message' => 'Delivery could not be created.'
        ];
    }
    }else{
                $data = $item->checkDeliveryExist();
                $returnData = [
        'success' => 0,
        'message' => $data['user_name']. ' Already Delivered '.$data['quantity'].' Quantity'
        ];
    }
    echo json_encode($returnData);  
?>