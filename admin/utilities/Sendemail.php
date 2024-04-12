<?php 
class Sendemail{

    public function sendMail($email, $subject, $message){
        $to      = $email;
$subject = $subject;
$message = $message;
$headers = array(
    'From' => $email,
    'Reply-To' => $email,
    'X-Mailer' => 'PHP/' . phpversion()
);
        return mail($to, $subject, $message, $headers);
    }
}