<?php
if (session_id() == '') {
  session_start();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './../../vendor/autoload.php';
if (isset($_SESSION['username'])) {
  $targetfolder = "../../uploads/";
  $targetfolder = $targetfolder . basename($_FILES['file']['name']);
  //upload file
  if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
    //echo "The file " . basename($_FILES['file']['name']) . " is uploaded <br>";
    //send mail
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    try {
      $client = $_SESSION['username'];
      $code = $_SESSION['code_poste'];
      $subject = "Note Client";
      $message = "Une Fiche ecoute client a été envoyé de la part d' ".$client."
          <table style='width:100%'>
         <tr><td>Code Client: " . $code . "</td></tr>
         </table>";
      //Server settings
      //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                   // Specify main and new SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'devbproject@gmail.com';                 // SMTP username
      $mail->Password = 'Aezakmi@1989';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to
      //Recipients
      $mail->setFrom('devbproject@gmail.com', 'Groupe Semos');
      $mail->addAddress('bayram.bani@gmail.com', 'Web Master');     // Add a recipient
      //$mail->addAddress($email);               // Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
      //Attachments
      $mail->addAttachment('../../uploads/' . $code . '.pdf');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $message;
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
      header("location: ../../index.php?page=fiche_ecoute_client&res=ok#form_fiche_ecoute");
    } catch (Exception $e) {
      //$err= 'Mailer Error: ' . $mail->ErrorInfo;
      header("location: ../../index.php?page=fiche_ecoute_client&res=err_send_mail#form_fiche_ecoute");
    }
  } else {
    header("location: ../../index.php?page=fiche_ecoute_client&res=err_upload#form_fiche_ecoute");
  }
}
else{
  header("location: ../../index.php?page=fiche_ecoute_client&res=err_session#form_fiche_ecoute");
}
?>
