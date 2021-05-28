<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");

    include_once '../config/database.php';
    include_once '../class/store.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Store($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->location = $data->location;
    
if($item->createStore()){
        $returnData = [
        'success' => 1,
        'message' => 'Store created successfully.'
        ];
    } else{
        $returnData = [
        'success' => 0,
        'message' => 'Store could not be created.'
        ];
    }
  
        echo json_encode($returnData); 


?>