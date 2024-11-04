<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NewsLetterMail {
    public function sendConfirmationNewsletterMail($email, $username) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'correopruebadani1@gmail.com'; 
            $mail->Password = 'ouum tjig jsim jccp'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587; 

            // Remitente y destinatario
            $mail->setFrom('noreply@hogarsol-web.com', 'Asociación Infantil Hogar Sol');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Registro para el Boletín Informativo';
            $mail->Body    = 'Buenas' .$username. 'Le agradecemos su registro para el boletín informativo';

            $mail->send();
            echo 'El correo de confirmación ha sido enviado';
        } catch (Exception $e) {
            echo "El correo no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
