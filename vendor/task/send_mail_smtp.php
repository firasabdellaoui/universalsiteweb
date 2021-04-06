<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["email"])) {
   //Load composer's autoloader
   require '../autoload.php';

   $mail = new PHPMailer(true);// Passing `true` enables exceptions
   $task = 'contact';
   try {
      $name = $_POST["name"];
      $email= $_POST["email"];
      $text= $_POST["message"];

      if (isset($_POST["subject"])) {
         $subject= $_POST["subject"];
      }else{
         $subject="Demande Devis";
      }

      if (isset($_POST["phone"])) {
         $phone= $_POST["phone"];
      }else{
         $phone="";
      }

      if (isset($_POST["besoin"])) {
         $besoin= $_POST["besoin"];
      }else{
         $besoin="";
      }

      if ($subject == "Demande Devis")
      {
         $message = '<table style="width:100%">
         <tr><td>Nom: ' . $name . '</td></tr>
         <tr><td>Email: ' . $email . '</td></tr>
         <tr><td>Téléphone: ' . $phone . '</td></tr>
         <tr><td>Besoin: ' . $besoin . '</td></tr>
         <tr><td>Message: ' . $text . '</td></tr>        
         </table>';
      }
      else
      {
         $message = '<table style="width:100%">
         <tr><td>Nom: ' . $name . '</td></tr>
         <tr><td>Email: ' . $email . '</td></tr>
         <tr><td>Sujet: ' . $subject . '</td></tr>
         <tr><td>Message: ' . $text . '</td></tr>        
         </table>';
      }


      //Server settings
      //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                   // Specify main and new SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'devbproject@gmail.com';                 // SMTP username
      $mail->Password = '';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('devbproject@gmail.com', 'Groupe Semos');
      $mail->addAddress('bayram.bani@gmail.com', 'Web Master');     // Add a recipient
      $mail->addAddress($email);               // Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $message;
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Votre message a été envoyé';
   } catch (Exception $e) {
      echo 'Une erreur s\'est produite!';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
   }
}
?>
