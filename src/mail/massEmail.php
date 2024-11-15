<?php

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

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
            $this->mail->setFrom('noreply@hogarsol-web.com', 'Asociación Infantil Hogar Sol');
            $this->mail->isHTML(true);  // Permitir HTML en el mensaje
            $this->mail->CharSet = 'UTF-8';  // Asegurar que se usen caracteres UTF-8
        } catch (Exception $e) {
            error_log("Error al configurar PHPMailer: " . $e->getMessage());
        }
    }

    public function sendEmail($to, $subject, $body, $image = null) {
        try {
            $this->mail->addAddress($to);      // Destinatario
            $this->mail->Subject = $subject;   // Asunto del correo

            // Formato del cuerpo del correo con los estilos solicitados
            $htmlContent = '
            <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                            width: 100%;
                            background-color: #f4f4f4;
                        }

                        .container {
                            width: 100%;
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #ffffff;
                            padding: 20px;
                            box-sizing: border-box;
                        }

                        h3 {
                            color: hsl(216, 80%, 47%);
                            text-align: center;
                            font-size: 24px;
                        }

                        p {
                            font-size: 16px;
                            color: #555;
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .logo {
                            display: block;
                            margin: 0 auto;
                            width: 150px;  /* Esto asegura que la imagen tenga un tamaño moderado */
                            max-width: 100%; /* Asegura que no exceda el ancho del contenedor */
                            height: auto; /* Mantiene la proporción original de la imagen */
                        }

                        img {
                            border-radius: 5px;
                        }

                        @media (max-width: 600px) {
                            h3 {
                                font-size: 20px;
                            }

                            p {
                                font-size: 14px;
                            }

                            .button {
                                padding: 10px 20px;
                            }

                            .logo {
                                width: 120px;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h3>' . $subject . '</h3>
                        <p>' . nl2br($body) . '</p>
                        <!-- Botón de confirmación (puedes agregar un botón aquí si es necesario) -->
                        <!-- Logo incrustado -->
                        <br>
                        <img src="cid:logo_cid" alt="Logo" class="logo" />
                    </div>
                </body>
            </html>
        ';

            $this->mail->Body = $htmlContent; // Cuerpo del correo con el formato HTML

            // Adjuntar imagen si se ha subido y agregarla como CID
            if ($image) {
                if (isset($image['tmp_name']) && file_exists($image['tmp_name'])) {
                    error_log('Añadiendo imagen adjunta: ' . $image['name']);
                    $this->mail->addEmbeddedImage($image['tmp_name'], 'logo_cid', $image['name']); // Incrustar la imagen como CID
                } else {
                    error_log('La imagen no es válida o no se recibió correctamente.');
                }
            }

            $this->mail->send();
            $this->mail->clearAddresses();     // Limpia las direcciones después de enviar
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar correo a {$to}: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    public function sendMassEmail(array $recipients, $subject, $body, $image = null) {
        foreach ($recipients as $recipient) {
            // Enviar correo a cada destinatario
            $this->sendEmail($recipient['USERMAIL'], $subject, $body, $image);
        }
    }
}

?>