<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/medicines.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Medicines($db);

    $item->med_id = isset($_GET['med_id']) ? $_GET['med_id'] : die();
  
    $item->getSingleMedicines();

    if($item->name != null){
        // create array
        $med_arr = array(
            "med_id" =>  $item->med_id,
            "name" => $item->name,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at
        );
      
        http_response_code(200);
        echo json_encode($med_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Medicines not found.");
    }
?>