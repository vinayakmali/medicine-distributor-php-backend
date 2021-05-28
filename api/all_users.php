<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: *");
    
    include_once '../config/database.php';
    include_once '../class/users.php';



    $database = new Database();
    $db = $database->getConnection();

    $items = new Users($db);
    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $usersArr = array();
        $usersArr["body"] = array();
        $usersArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            

            array_push($usersArr["body"], $row);
        }
        echo json_encode($usersArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>