<?php
    
    class dbConnection  {
        protected $conn;
        public $username = 'root';
        public $password = '';
        public $host = 'localhost';
        public $db = 'Sofia';


        public function connect(){
            try{
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db",$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                return $this->conn;
            }
            catch(PDOException $e){
                return false;
                // return "Error:".$e->getMessage();
            }
        }



    }



?>