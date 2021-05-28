<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/users.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Users($db);

    $data = json_decode(file_get_contents("php://input"));
    $item->name = $data->name;
    $item->email = $data->email;
    $item->role = $data->role;
    $item->password = $data->password;
    
    if ($item->checkUserExist() == '') {
        # code...
    if($item->createUsers()){
        $returnData = [
        'success' => 1,
        'message' => 'User created successfully.'
        ];
    } else{
        $returnData = [
        'success' => 0,
        'message' => 'User could not be created.'
        ];
    }
    }else{
                $returnData = [
        'success' => 0,
        'message' => 'User Already exist.'
        ];
    }
    echo json_encode($returnData);  
?>