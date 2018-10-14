<?php
    function send_email($to,$message,$subject){
        //Setup
        require_once('sendemail.php');
        
        $mail-> setFrom(' ', 'eVoter');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        return $mail->send();
    }
?>