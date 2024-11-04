<?php

require_once '../models/newsletterModel.php';
require_once '../mail/newsletterMail.php';

class NewsletterController {
    private $newsletterModel;

    public function __construct() {
        $this->newsletterModel = new NewsletterModel();
    }

    public function registerNewsletter($userMail, $userName, $userLastname1, $userLastname2) {
        // Verifica si el correo ya existe
        if ($this->newsletterModel->checkEmailExists($userMail)) {
            return ['status' => 'error', 'message' => 'El correo electrónico ya está registrado.'];
        }

        // Procede a registrar si no existe
        if ($this->newsletterModel->registerNewsletter($userMail, $userName, $userLastname1, $userLastname2)) {
            // Envía el correo de confirmación de registro
            $mail = new NewsLetterMail();
            if ($mail->sendConfirmationNewsletterMail($userMail, $userName)) {
                return ['status' => 'success', 'message' => 'Correo enviado y registrado correctamente.'];
            } else {
                // Si el correo no se envía, devuelve un error
                return ['status' => 'error', 'message' => 'Error al enviar el correo.'];
            }
        }
        return ['status' => 'error', 'message' => 'Error al registrar.'];
    }
}


?>