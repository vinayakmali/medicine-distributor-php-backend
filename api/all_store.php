<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: *");

    include_once '../config/database.php';
    include_once '../class/store.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Store($db);
    $stmt = $items->getStore();
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