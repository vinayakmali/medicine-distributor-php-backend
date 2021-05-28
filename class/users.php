<?php
    class Users{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $id;
        public $name;
        public $pass;
        public $age;
        public $designation;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUsers(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createUsers(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name,
                        email = :email, 
                        password = :password, 
                        role = :role, 
                        created_at = '".date("Y-m-d H:i:s")."'";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags(md5($this->password)));
            $this->role=htmlspecialchars(strip_tags($this->role));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":role", $this->role);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleUsers(){
            $sqlQuery = "SELECT
                        id, 
                        name,
                        email, 
                        role,
                        created_at,
                        updated_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->role = $dataRow['role'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
        }

                // UPDATE
        public function checkUserExist(){
            $sqlQuery = "SELECT
                        id, 
                        name,
                        email, 
                        role,
                        created_at,
                        updated_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       email = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->email);

            $stmt->execute();

            return $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
        }        

        // UPDATE
        public function updateUsers(){
            // bind data
            $name1 = $role1 = $email1 = $longitude1 = $latitude1 = '';
            if (!empty($this->name)) {
            $name1 = "name = '".$this->name."',";
            }
            if (!empty($this->email)) {
                # code...
                        $email1 = "email = '".$this->email."',";
            }
            if (!empty($this->latitude)) {
                # code...
                        $lat = $this->latitude;

                        $latitude1 = "lat = '".$lat."',";
            }

             if (!empty($this->longitude)) {
                # code...
                        $lon = $this->longitude;

                         $longitude1 .= "lon = '".$lon."',";
            }
            if (!empty($this->role)) {
                # code...
                        $role1 = "role = '".$this->role."',";
            }
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        ". $name1.$email1.$role1.$longitude1.$latitude1." 
                        updated_at = '".date("Y-m-d H:i:s")."'
                    WHERE 
                        id = ".$this->id;
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id", $this->id);
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUsers(){
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

