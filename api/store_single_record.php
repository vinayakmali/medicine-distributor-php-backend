<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/store.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Store($db);

    $item->store_id = isset($_GET['store_id']) ? $_GET['store_id'] : die();
  
    $item->getSingleStore();

    if($item->name != null){
        // create array
        $med_arr = array(
            "store_id" =>  $item->store_id,
            "name" => $item->name,
            "store" => $item->store,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at
        );
      
        http_response_code(200);
        echo json_encode($med_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Store not found.");
    }
?>