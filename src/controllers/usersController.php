<?php
require_once '../models/usersModel.php';
require_once '../mail/confirmationMail.php';

class UsersController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function registerUser($userName, $userLastname1, $userLastname2, $userMail) {
        $confirmation_code = bin2hex(random_bytes(16)); // Genera un código de confirmación
        if ($this->userModel->registerUser($userName, $userLastname1, $userLastname2, $userMail, $confirmation_code)) {
            // Envía el correo de confirmación
            $mail = new Mail();
            $mail->sendConfirmationEmail($userMail, $confirmation_code);
            return true;
        }
        return false;
    }

    public function confirmUser($codigo_confirmacion) {
        return $this->userModel->confirmUser($codigo_confirmacion);
    }
}
