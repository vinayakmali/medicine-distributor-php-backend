<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: *");

    include_once '../config/database.php';
    include_once '../class/delivery.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Delivery($db);

    $data = json_decode(file_get_contents("php://input"));

    $user_id = $data->user_id;
    $type = $data->type;

    $stmt = $items->getDelivery($user_id,$type);
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        
        $storeArr = array();
        $storeArr["body"] = array();
        $storeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            

            array_push($storeArr["body"], $row);
        }
        echo json_encode($storeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>