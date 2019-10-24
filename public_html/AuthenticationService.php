<?php 

    require 'db_conn.php';

    class AuthService{
        private $conn;

        public function __construct(){
            
            $conn = new dbConnection().connect();

        }

        public function addUser($fname,$lname="",$email, $password){
        
            if($conn){
                $psw = md5($password);
                $token = md5(uniqid($email,true));
                $stmt = $conn->prepare("INSERT INTO user(firstname,lastname,email,psw,enable,token) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$fname,$lname,$email,$psw,0,$token]);
                return token;

            }else{
                return false;
            }
        
        }

        public function findUser($email,$password){
            if($conn){
                $psw = md5($password);
                $stmt = $con->prepare("SELECT * FROM user WHERE email=? AND psw=? AND enable=1 ");
                $stmt.execute([$email,$password]);
                $user = $stmt->fetch();
                if( $stmt->rowCount()>0 )
                    return $stmt->fetch();
                else
                    return false;
            }
            return false;
        }
        
        public function forgotPsw($email){

            if($conn){
                $token = md5(uniqid($email,true));
                $stmt = $conn->prepare("UPDATE user SET token=? WHERE email=? AND enable=1");
                if($stmt.execute([$token,$email]))
                    return token;
            }
        }
    }


?>
