<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

$alert = '';

// Condition
if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';//gmail smtp host
        $mail->SMTPAuth = true; //setting auth to true
        $mail->Username = 'tasty.creator.inc@gmail.com';
        $mail->Password = 'huxptneooxnemzgt';
        
        // setting encryption
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Setting the port of the gmail server
        $mail->Port = '587';

        $mail->setFrom($email, $username);
        $mail->addAddress('tasty.creator.inc@gmail.com');
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = "<h3>Name : $username <br>Email : $email<br>Message : $msg</h3>";

        // Sending mail
        $mail->send();

         // Sending user back contact us form
         header("Location: ../routing/contactus.php"); 

        // Creating a alert success message
        $alert = '<div class="alert-success">
                <span>Message Sent! Thank You for contacting us.</span>
                </div>';
    }catch(Exception $e){
        $alert = '<div class="alert-error">
        <span>'.$e->getMessage().'</span>
        </div>';
    }
}
?>