<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MassEmail {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        try {
            // Configuración SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';  // Configura tu servidor SMTP
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'correopruebadani1@gmail.com'; // Usuario SMTP
            $this->mail->Password = 'ouum tjig jsim jccp';           // Contraseña SMTP
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            $this->mail->setFrom('tu_correo@tu_dominio.com', 'Tu Nombre');
            $this->mail->isHTML(true);  // Permitir HTML en el mensaje
        } catch (Exception $e) {
            error_log("Error al configurar PHPMailer: " . $e->getMessage());
        }
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mail->addAddress($to);      // Destinatario
            $this->mail->Subject = $subject;   // Asunto del correo
            $this->mail->Body = $body;         // Cuerpo del mensaje

            $this->mail->send();
            $this->mail->clearAddresses();     // Limpia las direcciones después de enviar
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar correo a {$to}: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    public function sendMassEmail(array $recipients, $subject, $body) {
        foreach ($recipients as $recipient) {
            $this->sendEmail($recipient['USERMAIL'], $subject, $body);
        }
    }
}
