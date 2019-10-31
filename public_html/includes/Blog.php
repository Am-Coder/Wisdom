<?php
    require 'db_conn.php';

    class Blog{
        
        private $conn;

        public function __construct(){
            $this->conn = new dbConnection();
            $this->conn = $conn->connect();  
        }

        public function fetchAll($page){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT * FROM blog LIMIT 10 OFFSET ? ORDER BY claps ");
                $stmt->execute([2*$page]);
                return $stmt->fetchAll();
            }

            return false;
        }   

        public function fetchByGenre($page,$genre){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT * FROM blog WHERE genre=? LIMIT 10 OFFSET ? ORDER BY claps ");
                $stmt->execute([$genre,2*$page]);
                return $stmt->fetchAll();
            }

            return false;
        }   

        

    }
?>