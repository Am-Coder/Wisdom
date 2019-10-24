

<!-- The authentication object -->
<?php 

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
    protected $mailer;
    

    public function __construct( ){
        
        // $this->fname = $fname;
        // $this->lname = $lname;
        // $this->email = $email;
        // $this->password = $password;
        $this->mailer = new PHPMailer(true);

    }

    
    public function signup($fname, $lname, $email, $password){
        try { 
            $mail->SMTPDebug = 2;                                        
            $mail->isSMTP();                                             
            $mail->Host       = 'smtp.gmail.com;';                     
            $mail->SMTPAuth   = true;                              
            $mail->Username   = 'ragnar.viking.1998.kia@gmail.com';                  
            $mail->Password   = 'ragnar.ragnar';                         
            $mail->SMTPSecure = 'tls';       //or ssl                        
            $mail->Port       = 587;   //465 for ssl
            
            $authservice = new AuthService();
            $info = $authservice->addUser($fname,$lname,$email,$password);

            $mail->setFrom('ragnar.viking.1998.kia@gmail.com', 'RL');            
            $mail->addAddress($email); 
            
            $mail->isHTML(true);                                   
            $mail->Subject = 'Account Verification'; 

            
            $mail->Body    = '<b>Follow the link to activate your account:</b><br><a href="#!">Click Here</a><br><br> ';

            $mail->AltBody = "<h2>Let's create a healthy community together !!!!</h2>"; 
            if( $mail->send() ) 
                return true;
        } catch (Exception $e) { 
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false; 
        } 
   
    }

    public function signin($email,$password){
        $authservice = new $AuthService();
        $user = $authservice->findUser($email,$password);
        if( $user ){
            return true;
        }
        return false;
    }
    
    public function forgotPassword($email){
        $authservice = new AuthService();
        $token = $authservice.forgotPsw($email);
        if( $token ){
            try { 
                $mail->SMTPDebug = 2;                                        
                $mail->isSMTP();                                             
                $mail->Host       = 'smtp.gmail.com;';                     
                $mail->SMTPAuth   = true;                              
                $mail->Username   = 'ragnar.viking.1998.kia@gmail.com';                  
                $mail->Password   = 'ragnar.ragnar';                         
                $mail->SMTPSecure = 'tls';       //or ssl                        
                $mail->Port       = 587;   //465 for ssl
                
    
                $mail->setFrom('ragnar.viking.1998.kia@gmail.com', 'RL');            
                $mail->addAddress($email); 
                
                $mail->isHTML(true);                                   
                $mail->Subject = 'Forgot Password'; 
    
                
                $mail->Body    = '<b>Follow the link to reset your password:</b><br><a href="#!">Click Here</a><br><br> ';
    
                $mail->AltBody = "<h2>Let's create a healthy community together !!!!</h2>"; 
                if( $mail->send() ) 
                    return true;
            } catch (Exception $e) { 
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false; 
            } 

        }


    }
}
?>