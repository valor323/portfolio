<?php
$dir = dirname(__FILE__);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $dir . '/PHPMailer/src/Exception.php';
require $dir . '/PHPMailer/src/PHPMailer.php';
require $dir . '/PHPMailer/src/SMTP.php';

class sendEmail{
  public $mail,$sendFrom,$sendFromEmail,$sendToEmail,$sendToName,$subject,$Body;
  public function __construct() {
      $this->mail = new PHPMailer;
      $this->mail->isSMTP();                                      // Set mailer to use SMTP
      $this->mail->Host = 'EDIT HERE';                      // Specify main and backup SMTP servers
      $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
      $this->mail->Username = 'EDIT HERE';                 // SMTP username
      $this->mail->Password = 'EDIT HERE';                 // SMTP password
      $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $this->mail->Port = EDIT_HERE;
      $this->mail->IsHTML(true);
  }
  public function send(){
      $this->mail->setFrom('EDIT HERE', $this->sendFrom);
      $this->mail->addAddress('EDIT HERE', 'EDIT HERE');     // Add a recipient
      $this->mail->Subject = $this->subject;
      $this->mail->Body    = $this->Body;
      if(!$this->mail->send()) {
          return false;
      } else {
          return true;
      }
  }
}
