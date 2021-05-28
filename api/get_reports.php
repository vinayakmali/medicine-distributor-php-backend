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

    $items = new Delivery($db);
    $data = json_decode(file_get_contents("php://input"));
    $type = $data->type;

if ($type == 'citywise') {
    
    $stmt = $items->cityWiseDeliveryCountReport();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){

        $medicinesArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);        
            array_push($medicinesArr, $row);
        }

        $counter =1;
        $newarr = array();
        $datearr = array();
        $final_array = array();

        foreach ($medicinesArr as $key => $value) {

            $keys =  array_keys($newarr);

            for ($i=1; $i < 8; $i++) {
                $date =  date('Y-m-d', strtotime('-'.$i.' days'));
                if ($counter == 1) {
                   $datearr[] = $date;
                }
                if ($date == $value['delivery_date']) {
                    $newarr[$value['location']]['delivery_count'][$date] = $value['delivery_count']; 
                }elseif(in_array($value['location'], $keys) && $counter > 1){
                }else{
                    $newarr[$value['location']]['delivery_count'][$date] = 0;
                }
            }
            $counter++;
        }
        $final_array['data'] = $newarr;
        $final_array['label'] = $datearr;
        echo json_encode($final_array);
    }

}else if($type == 'agentwise'){
    
    $stmt = $items->agentWisePerMonthReport();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){

        $medicinesArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);        
            array_push($medicinesArr, $row);
        }

        $counter =1;
        $newarr = array();
        $datearr = array();
        $final_array = array();

        foreach ($medicinesArr as $key => $value) {

            $keys =  array_keys($newarr);

            for ($i=1; $i < 31; $i++) {
                $date =  date('Y-m-d', strtotime('-'.$i.' days'));
                if ($counter == 1) {
                   $datearr[] = $date;
                }
                if ($date == $value['delivery_date']) {
                    $newarr[$value['name']]['delivery_count'][$date] = $value['delivery_count']; 
                }elseif(in_array($value['name'], $keys) && $counter > 1){
                }else{
                    $newarr[$value['name']]['delivery_count'][$date] = 0;
                }
            }
            $counter++;
        }
        $final_array['data'] = $newarr;
        $final_array['label'] = $datearr;
        echo json_encode($final_array);
    }
}elseif($type == 'returnMedicineReport'){


    $stmt = $items->returnCountReport();
     $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        $medicinesArr = array();
        $medicinesArr["name"] = array();
        $medicinesArr["return_count"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            if (empty($row['return_count'])) {
                        array_push($medicinesArr["return_count"], 0);
            }else{
                        array_push($medicinesArr["return_count"], $row['return_count']);
            }
            array_push($medicinesArr["name"], $row['name']);
        }


        echo json_encode($medicinesArr);
    } 


}else if($type == 'deliveredMedicineReport'){
    
    $stmt = $items->deliveredCountReport();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){

        $medicinesArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);        
            array_push($medicinesArr, $row);
        }

        $counter =1;
        $newarr = array();
        $datearr = array();
        $final_array = array();

        foreach ($medicinesArr as $key => $value) {

            $keys =  array_keys($newarr);

            for ($i=1; $i < 17; $i++) {
                $date =  date('Y-m-d', strtotime('-'.$i.' days'));
                if ($counter == 1) {
                   $datearr[] = $date;
                }

                if (empty($value['return_count'])) {
                    $value['return_count'] = 0;
                }


                if (empty($value['quantity'])) {
                     $value['quantity'] = 0;
                }


                if ($date === $value['delivery_date']) {
                    $newarr[$value['name']]['delivery_count'][$date] = $value['quantity'] - $value['return_count'];


                }elseif(in_array($value['name'], $keys) && $counter > 1){
                }else{
                    $newarr[$value['name']]['delivery_count'][$date] = 0;
                }
            }
            $counter++;
        }
        $final_array['data'] = $newarr;
        $final_array['label'] = $datearr;
        echo json_encode($final_array);
    }
}

 
?>