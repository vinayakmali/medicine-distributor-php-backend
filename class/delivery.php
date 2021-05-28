<?php
    class Delivery{

        // Connection
        private $conn;

        // Table
        private $db_table = "delivery_target";

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDelivery($user_id,$type){
            
            $condition = '';
            if ($type == 'agent') {
                $condition = ' where dt.user_id = '.$user_id;
            }
            $sqlQuery = "SELECT dt.del_id as id,u.name as user_name,u.lat as lat,u.lon as lon,m.name as med_name, s.name as store_name, dt.quantity, dt.returnedTarget as return_count,dt.created_at as delivery_date FROM `delivery_target` as dt left join users as u on dt.user_id = u.id left join medicines as m on dt.med_id = m.med_id left join store as s on s.store_id = dt.store_id".$condition;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createDelivery(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        user_id = :user_id,
                        med_id = :med_id,
                        store_id = :store_id, 
                        quantity = :quantity, 
                        created_at = '".date("Y-m-d H:i:s")."'";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->med_id=htmlspecialchars(strip_tags($this->med_id));
            $this->store_id=htmlspecialchars(strip_tags($this->store_id));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":med_id", $this->med_id);
            $stmt->bindParam(":store_id", $this->store_id);
            $stmt->bindParam(":quantity", $this->quantity);
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleDelivery(){
            $sqlQuery = "SELECT
                        med_id, 
                        name, 
                        created_at, 
                        updated_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       med_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->med_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];

        }        

        // UPDATE
        public function updateDelivery(){
                        $returnedTarget1 = '';
            if (!empty($this->returnedTarget)) {
            $returnedTarget1 = "returnedTarget = '".$this->returnedTarget."',";
            }

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        ". $returnedTarget1." 
                        updated_at = '".date("Y-m-d H:i:s")."'
                    WHERE 
                        del_id = ".$this->del_id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function checkDeliveryExist(){
            $sqlQuery = "SELECT dt.del_id as id,u.name as user_name,m.name as med_name, s.name as store_name, dt.quantity, dt.returnedTarget as return_count,dt.created_at as delivery_date FROM `delivery_target` as dt left join users as u on dt.user_id = u.id left join medicines as m on dt.med_id = m.med_id left join store as s on s.store_id = dt.store_id
                    WHERE 
                       dt.med_id = ".$this->med_id."
                       AND dt.store_id = ".$this->store_id."
                       AND dt.created_at >= CURDATE();

                    LIMIT 0,1";


            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
        }

        // DELETE
        function deleteDelivery(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


                public function cityWiseDeliveryCountReport(){
      /*      $sqlQuery = "SELECT count(del_id) as delivery_count,s.location FROM `delivery_target` as dt right join store as s on dt.store_id = s.store_id group by s.location";

$stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            */


              $sqlQuery = "SELECT count(del_id) as delivery_count,s.location,DATE(dt.created_at)  as delivery_date FROM `delivery_target` as dt join store as s on dt.store_id = s.store_id group by s.location,DATE(dt.created_at)";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }



        public function agentWisePerMonthReport(){

              $sqlQuery = "SELECT count(del_id) as delivery_count,u.name,DATE(dt.created_at)  as delivery_date FROM `delivery_target` as dt join users as u on dt.user_id = u.id group by u.id,DATE(dt.created_at)";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;   
        }


         public function returnCountReport(){

              $sqlQuery = "SELECT sum(dt.returnedTarget) as return_count,s.name FROM `delivery_target` as dt right join store as s on dt.store_id = s.store_id group by s.store_id";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;   
        }

         public function deliveredCountReport(){

              $sqlQuery = "SELECT sum(dt.returnedTarget) as return_count,sum(quantity) as quantity,s.name,DATE(dt.created_at) as delivery_date FROM `delivery_target` as dt right join store as s on dt.store_id = s.store_id group by s.store_id";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;   
        }

    }
?>

