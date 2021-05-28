<?php
    class Medicines{

        // Connection
        private $conn;

        // Table
        private $db_table = "medicines";

        // Columns
        public $med_id;
        public $name;
        public $created_at;
        public $updated_at;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMedicines(){
            $sqlQuery = "SELECT med_id as id, name FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createMedicines(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        created_at = '".date("Y-m-d H:i:s")."'";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleMedicines(){
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
        public function updateMedicines(){
                        $name1 = '';
            if (!empty($this->name)) {
            $name1 = "name = '".$this->name."',";
            }

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        ". $name1." 
                        updated_at = '".date("Y-m-d H:i:s")."'
                    WHERE 
                        med_id = ".$this->med_id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteMedicines(){
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

