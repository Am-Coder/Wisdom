<?php 

    require 'db_conn.php';

    class AuthService{
        // private static $conn;

        // public function __construct(){
            
        //     $conn = new dbConnection();
        //     $conn = $conn->connect();
        // }

        public function addUser($fname,$lname="",$email, $password){
            $conn = new dbConnection();
            $conn = $conn->connect();        
            if($conn){
                $psw = md5($password);
                $token = md5(uniqid($email,true));
                $stmt = $conn->prepare("INSERT INTO user(firstname,lastname,email,psw,enable,token) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$fname,$lname,$email,$psw,0,$token]);
                return $token;

            }else{
                return false;
            }
        
        }

        public function findUser($email,$password){
            $conn = new dbConnection();
            $conn = $conn->connect(); 
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
            $conn = new dbConnection();
            $conn = $conn->connect();
            if($conn){
                $token = md5(uniqid($email,true));
                $stmt = $conn->prepare("UPDATE user SET token=? WHERE email=? AND enable=1");
                if($stmt.execute([$token,$email]))
                    return token;
            }
        }

        public function findAndCheckTokenByEmail($oritoken,$email){
            $conn = new dbConnection();
            $conn = $conn->connect();
            if($conn){
                $stmt = $conn->prepare("SELECT token FROM user WHERE email=?");
                $stmt.execute([$email]);
                $token = $stmt->fetch();
                if( $token == $oritoken ){
                    return true;
                }else{
                    return false;
                }
            }else return false;            
        }

        public function verifyAccount($oritoken,$email){
            $conn = new dbConnection();
            $conn = $conn->connect();            
            if( $conn ){
                $stmt = $conn->prepare("UPDATE user SET enable=1 WHERE email=? AND token=?");
                $stmt->execute([$email,$oritoken]);
                if( $stmt->rowCount()>0 ){
                    $stmt = $conn->prepare("UPDATE user SET token='' WHERE email=?");
                    $stmt->execute([$email]);
                   return true; 
                }
                return false;
            }

            return false;
        }


    }


?>
