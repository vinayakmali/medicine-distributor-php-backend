<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
          header("Access-Control-Allow-Headers: *");
  
    include_once '../config/database.php';
    include_once '../class/medicines.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Medicines($db);
    $stmt = $items->getMedicines();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $medicinesArr = array();
        $medicinesArr["body"] = array();
        $medicinesArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            

            array_push($medicinesArr["body"], $row);
        }
        echo json_encode($medicinesArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>