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
            $mail->CharSet = 'UTF-8'; // Establece la codificación UTF-8
            $mail->Subject = 'Confirmación de Registro para el Boletín Informativo';

            // Cargar la plantilla
            $template = file_get_contents('../mail/templates/newsletterRegister.html'); // Ruta a tu plantilla
            $body = str_replace(['{{username}}'], [$username], $template); // Reemplazar variables en la plantilla
            $mail->Body = $body;

            try {
                $mail->addEmbeddedImage(__DIR__ . '/../../public/images/logo.png', 'logo_cid');
            } catch (Exception $e) {
                echo 'Error al adjuntar la imagen: ' . $e->getMessage();
            }
            

            $mail->send();
            return true; // Envío exitoso
        } catch (Exception $e) {
            // Maneja el error, loguea si es necesario
            return false; // Indica que hubo un problema
        }
    }
}
?>
