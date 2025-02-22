

<?php 
// <!-- The authentication object -->

//Php mailer class added
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'AuthenticationService.php';


class Authenticate{

    // protected $fname;
    // protected $lname;
    // protected $email;
    // protected $password;
    protected $mail;
    

    public function __construct( ){
        
        // $this->fname = $fname;
        // $this->lname = $lname;
        // $this->email = $email;
        // $this->password = $password;
        $this->mail = new PHPMailer(true);

    }

    
    public function signup($fname, $lname, $email, $password){
        try { 
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2;                                        
            $mail->isSMTP();                                             
            $mail->Host       = 'smtp.gmail.com;';                     
            $mail->SMTPAuth   = true;                              
            $mail->Username   = 'your gmail';                  
            $mail->Password   = 'your password for mail';                         
            $mail->SMTPSecure = 'tls';       //or ssl                        
            $mail->Port       = 587;   //465 for ssl
            
            $authservice = new AuthService();
            $info = $authservice->addUser($fname,$lname,$email,$password);
            echo $info;
            $mail->setFrom('ryour gmail', 'RL');            
            $mail->addAddress($email); 
            
            $mail->isHTML(true);                                   
            $mail->Subject = 'Account Verification'; 

            
            $mail->Body = '<b>Follow the link to activate your account:</b><br><a href="http://localhost:7777/sofia/public_html/Verify.php?email='.$email.'&token='.$info.'">Click Here</a><br><br> ';

            $mail->AltBody = "<h2>Let's create a healthy community together !!!!</h2>"; 
            if( $mail->send() ) 
                return true;
        } catch (Exception $e) { 
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false; 
        } 
   
    }

    public function signin($email,$password){
        $authservice = new AuthService();
        $user = $authservice->findUser($email,$password);
        if( $user ){
            return $user;
        }
        return false;
    }
    
    public function forgotPassword($email){
        $authservice = new AuthService();
        $info = $authservice->forgotPsw($email);
        if( $info ){
            try { 
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2;                                        
                $mail->isSMTP();                                             
                $mail->Host       = 'smtp.gmail.com;';                     
                $mail->SMTPAuth   = true;                              
                $mail->Username   = 'your gmail';                  
                $mail->Password   = 'your password for mail';                         
                $mail->SMTPSecure = 'tls';       //or ssl                        
                $mail->Port       = 587;   //465 for ssl
                
    
                $mail->setFrom('your gmail', 'RL');            
                $mail->addAddress($email); 
                
                $mail->isHTML(true);                                   
                $mail->Subject = 'Forgot Password'; 
    
                
                $mail->Body    = '<b>Follow the link to reset your password:</b><br><a href="http://localhost:7777/sofia/public_html/ForgotPsw.php?email='.$email.'&token='.$info.'">Click Here</a><br><br> ';
    
                $mail->AltBody = "<h2>Let's create a healthy community together !!!!</h2>"; 
                if( $mail->send() ) 
                    return true;
            } catch (Exception $e) { 
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false; 
            } 

        }
        return false;

    }
}
?>