<?php
    require 'db_conn.php';

    class Blog{
        
        private $conn;

        public function __construct(){
            $this->conn = new dbConnection();
            $this->conn = $this->conn->connect();  
        }

        public function fetchAll($page){
            if($this->conn){
                // $stmt = $this->conn->prepare("SELECT * FROM blog LIMIT 10 OFFSET ? ORDER BY claps ");
                // $stmt->execute([2*(int)$page]);

               
                $stmt = $this->conn->prepare("SELECT blogid,email,title,imagetoshow,claps,datepublished,genre FROM blog ORDER BY claps ");
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }   

        public function fetchByGenre($page,$genre){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT blogid,email,title,imagetoshow,claps,datepublished,genre FROM blog WHERE genre=? ORDER BY claps ");
                $stmt->execute([$genre]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }   

        

    }
?>