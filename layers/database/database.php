<?php
    class Database {
        private $conn;

        public function __construct($db_params){
            if($db_params) {
                $this->conn = new mysqli($db_params['host'] ,$db_params['username'], $db_params['password'], $db_params['database_name']);
            }else{
                echo('Database parameters not set');
            }
        }

        //  Execute database query
        public function execute($query) {
            return $this->conn->query($query);
        }

        //  Database Create (Insert document) [C]
        public function addData($table, $data) {
            $query = " INSERT INTO ".$table;
            $fs=0;
            $query .=" ( ";
            foreach($data as $dt => $val) {
                $fs++;
                if($fs == count($data)) {
                    $query .="`".$dt."`";
                }else{
                    $query .="`".$dt."`,";
                }
            }
            $yh=0;
            $query .=" ) VALUES ( ";
            foreach($data as $dt => $val) {
                $yh++;
                if($yh == count($data)) {
                    $query .="'".$val."'";
                }else{
                    $query .="'".$val."',";
                }
            }
            $query .=" )";
    
            if($this->conn->query($query) === TRUE) {
                return true;
            }else{
                return false;
            }
        }

        // Database Read  [R]
        public function fetch($res) { 
            $row = $res->fetch_assoc();
    
            return $row;
        }
        public function fetchAll($res) {
            if($res) {
                $data = [];
            
                while($row = $res->fetch_assoc()) {
                    array_push($data,$row);
                }
    
                return $data;
            }else{
                return [];
            }
        }
        public function select($table, $constraints) {
            $query = "SELECT ".$constraints['select']." FROM ".$table;  
                
            if($constraints['logic']) {
                $lg=" WHERE ";
                foreach($constraints['logic']['data'] as $dt => $val) {
                    if($dt == "sep") {
                        $lg .= " ".$val;
                    }else{
                        $lg .=" `".$dt."` = '".$val."' ";
                    }
                }
                $retVal = ($constraints['logic']) ? $lg." ORDER BY id DESC" : "" ;
                $query .=$retVal;
            }
    
            $result = $this->conn->query($query);
    
            if($result->num_rows > 0) {
                return $result;
            }else{
                return false;
            }
        }

        //  Database Update [U]
        public function singleUpdate($data){
            $query = "UPDATE {$data['table']} SET {$data['column']} = '{$data['value']}' WHERE {$data['selector']} = '{$data['selector_value']}'";
            $stmt = $this->conn->query($query);
    
            if($stmt){
                return true;
            }else{
                return 0;
            }
        }
        public function MultipleUpdate($table, $data) {
            $query = " UPDATE ".$table;
            $fs=1;
            $query .=" SET ";
            foreach($data['data'] as $dt => $val) {
                if($fs == count($data['data'])) {
                    $query .=" `".$dt."` = '".$val."' ";
                }else{
                    $query .=" `".$dt."` = '".$val."', ";
                }
                $fs++;
            }
            $query .=" WHERE `{$data['selector']}` = '{$data['selector_value']}'"; 
            if($this->conn->query($query) === TRUE) {
                return true;
            }else{
                return false;
            }
        }

        // Databse Delete [D]
        public function Delete($table, $data) {
            $query = "DELETE FROM `{$table}` WHERE `{$data['selector']}` = '{$data['selector_value']}'";
            $stmt = $this->conn->query($query);
            if($stmt){
                return true;
            }else{
                return 0;
            }
        }
    }