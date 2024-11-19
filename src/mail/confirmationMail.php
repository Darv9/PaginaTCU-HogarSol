<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar las variables del archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, 'emails.env');
$dotenv->load();

class ConfirmationMail {
    public function sendConfirmationEmail($email, $confirmation_code) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'El correo electrónico no es válido.';
            return;
        }

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP usando variables de .env
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

            // Configurar el correo como HTML
            $mail->isHTML(true);
            $mail->CharSet = $_ENV['MAIL_CHARSET'];  
            $mail->Subject = 'Confirmación de Registro';

            // Genera la URL dinámica
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $basePath = $protocol . "://" . $host . "/hogarsolweb/PaginaTCU-HogarSol";
            $confirmation_url = $basePath . "/src/routes/mailValidationRoutes.php?code=" . urlencode($confirmation_code);

            // Crear botón de confirmación y plantilla
            $template = file_get_contents('../mail/templates/confirmationMail.html');
            $button = '<table role="presentation" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="border-radius: 5px; background-color: #3366CC; text-align: center;">
                    <a href="' . $confirmation_url . '" style="display: inline-block; padding: 10px 20px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold;">
                        Confirmar Registro
                    </a>
                </td>
            </tr>
        </table>';
            $body = str_replace('{{button}}', $button, $template);

            $mail->Body = $body;

            // Incrustar imagen de logo
            try {
                $mail->addEmbeddedImage(__DIR__ . '/../../public/images/logo.png', 'logo_cid');
            } catch (Exception $e) {
                echo 'Error al adjuntar la imagen: ' . $e->getMessage();
            }

            // Enviar correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
