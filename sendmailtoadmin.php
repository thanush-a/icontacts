<?php

if (isset($_POST['login_pb_back'])) {
     header('Location: index.php'); // Rediriger vers la page d'accuel
}

if (isset($_POST['login_pb_send'])) {
               //echo "test";
               $username = $_POST['contact_user'];
               $mailadresse = $_POST['contact_mail'];
               $numero = $_POST['contact_numero'];
               $nomprenom = $_POST['contact_nom'];
               $msgmail = $_POST['contact_msg'] . "<br><br>" . " par : " . $nomprenom . "<br>" . "username : " . $username . "<br>" . " mail : " . $mailadresse .
                              "<br>" ." numero : " . $numero ;

               date_default_timezone_set('Etc/UTC');
               require 'PHPMailer-master/PHPMailerAutoload.php';
               $mail = new PHPMailer;
               $mail->isSMTP();
               $mail->SMTPDebug = 0;
               $mail->Debugoutput = 'html';
               $mail->Host = 'smtp.gmail.com';
               $mail->Port = 587;
               $mail->SMTPSecure = 'tls';
               $mail->SMTPAuth = true;
               $mail->Username = "sisidu777@gmail.com";
               $mail->Password = "6491275018";
               $mail->setFrom('sisidu777@gmail.com', 'Admin BV1_iContacts');
               $mail->addReplyTo('sisidu777@gmail.com', 'Admin BV1_iContacts');
               $mail->addAddress('sisidu777@gmail.com', 'Admin BV1_iContacts');
               $mail->Subject = 'Problem rencontre lors de login par ' . $username ;
               $mail->msgHTML($msgmail);

               //echo "". $nommail . " " . $mailadresse . " ". $msgmail ;
               //$mail->AltBody = 'This is a plain-text message body';

               if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
               } else {
                   echo '<script type="text/javascript">alert("Mail à été envoyé :)");</script>';
                   //header('Location: index.php');
               }
}

?>
