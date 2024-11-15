<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ConfirmationMail {
    public function sendConfirmationEmail($email, $confirmation_code) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'El correo electrónico no es válido.';
            return;
        }

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

            // Configurar el correo como HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
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
