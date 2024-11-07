<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ConfirmationMail {
    public function sendConfirmationEmail($email, $confirmation_code) {
        // Validar el formato del correo
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
            $mail->CharSet = 'UTF-8'; // Codificación UTF-8
            $mail->Subject = 'Confirmación de Registro';

            // Cargar la plantilla del correo y reemplazar las variables
            $template = file_get_contents('../mail/templates/confirmationMail.html'); 
            $confirmation_url = "http://localhost/hogarsolweb/PaginaTCU-HogarSol/src/routes/mailValidationRoutes.php?code=" . $confirmation_code;
            $button = '<a href="' . $confirmation_url . '" style="padding: 10px 20px; background-color: hsl(216, 80%, 47%); color: white; text-decoration: none; border-radius: 5px;">Confirmar Registro</a>';
            $body = str_replace('{{button}}', $button, $template); 

            
            $mail->Body = $body;

            // Si es necesario, agregar una imagen incrustada
            try {
                $mail->addEmbeddedImage(__DIR__ . '/../../public/images/logo.png', 'logo_cid'); // Ruta a la imagen
            } catch (Exception $e) {
                echo 'Error al adjuntar la imagen: ' . $e->getMessage();
            }

            // Enviar el correo
            $mail->send();
            return true; //El correo se envia de forma exitosa
        } catch (Exception $e) {
            return false; //Error al enviar el correo
        }
    }
}
?>
