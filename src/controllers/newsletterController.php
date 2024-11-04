<?php
require_once '../models/newsletterModel.php';
require_once '../mail/newsletterMail.php';

class NewsletterController {
    private $newsletterModel;

    public function __construct() {
        $this->newsletterModel = new NewsletterModel();
    }

    public function registerNewsletter($userMail, $userName, $userLastname1, $userLastname2) {
        if ($this->newsletterModel->registerNewsletter($userMail, $userName, $userLastname1, $userLastname2)) {
            // Envía el correo de confirmación de registro
            $mail = new Mail();
            $mail->sendConfirmationEmail($userMail, $userName);
            return true;
        }
        return false;
    }
}
