<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Access-Control-Allow-Headers: *");

    include_once '../config/database.php';
    include_once '../class/medicines.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Medicines($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    
if($item->createMedicines()){
        $returnData = [
        'success' => 1,
        'message' => 'Medicines created successfully.'
        ];
    } else{
        $returnData = [
        'success' => 0,
        'message' => 'Medicines could not be created.'
        ];
    }
  
        echo json_encode($returnData); 
?>