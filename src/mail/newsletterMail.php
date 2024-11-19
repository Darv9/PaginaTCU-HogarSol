<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, 'emails.env');
$dotenv->load();

class NewsLetterMail {
    public function sendConfirmationNewsletterMail($email, $username) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP usando variables del archivo .env
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST']; 
            $mail->SMTPAuth = $_ENV['SMTP_AUTH'] == '1'; 
            $mail->Username = $_ENV['SMTP_USERNAME']; 
            $mail->Password = $_ENV['SMTP_PASSWORD']; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = $_ENV['SMTP_PORT']; 

            // Remitente y destinatario
            $mail->setFrom($_ENV['FROM_EMAIL'], $_ENV['FROM_NAME']);
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->CharSet = $_ENV['MAIL_CHARSET']; // UTF-8
            $mail->Subject = 'Confirmación de Registro para el Boletín Informativo';

            // Cargar la plantilla
            $template = file_get_contents('../mail/templates/newsletterRegister.html'); 
            $body = str_replace(['{{username}}'], [$username], $template); 
            $mail->Body = $body;

            try {
                // Incluir la imagen del logo
                $mail->addEmbeddedImage(__DIR__ . '/../../public/images/logo.png', 'logo_cid');
            } catch (Exception $e) {
                echo 'Error al adjuntar la imagen: ' . $e->getMessage();
            }

            // Enviar el correo
            $mail->send();
            return true; 
        } catch (Exception $e) {
            return false; 
        }
    }
}
?>
