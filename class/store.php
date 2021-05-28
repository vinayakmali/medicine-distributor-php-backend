<?php
    class Store{

        // Connection
        private $conn;

        // Table
        private $db_table = "store";

        // Columns
        public $store_id;
        public $name;
        public $location;
        public $created_at;
        public $updated_at;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getStore(){
            $sqlQuery = "SELECT store_id as id,name,location,created_at FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createStore(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name,
                        location = :location, 
                        created_at = '".date("Y-m-d H:i:s")."'";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->location=htmlspecialchars(strip_tags($this->location));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":location", $this->location);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleStore(){
            $sqlQuery = "SELECT
                        store_id, 
                        name, 
                        location,
                        created_at, 
                        updated_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       store_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->store_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->location = $dataRow['location'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];

        }        

        public function updateStore(){
            // bind data
            $name1 = $location1 = '';
            if (!empty($this->name)) {
            $name1 = "name = '".$this->name."',";
            }
            if (!empty($this->location)) {
                # code...
                        $location1 = "location = '".$this->location."',";
            }

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        ". $name1.$location1." 
                        updated_at = '".date("Y-m-d H:i:s")."'
                    WHERE 
                        store_id = ".$this->store_id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteStore(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

