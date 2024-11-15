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

    public function getAllNewsletterUsers() {
        $users = $this->newsletterModel->getAllNewsltterUsers();

        if($users){
            return ['status' => 'success', 'data' => $users];
        }else {
            return ['status' => 'error', 'message' => 'No se encontraron usuarios.'];
        }
    }

    public function deactivateUserNL($userId){
        if($this->newsletterModel->checkMailExists($userId)){
            $this->newsletterModel->deactivateUserNL($userId);
            return ['status' => 'success', 'message' => 'El usuario fue actualizado'];
        }else{
            return ['status' => 'error', 'message' => 'Error al actualizar el usuario.'];
        }
    }

    public function getUserByIdNL($userId) {
        $user = $this->newsletterModel->getUserByIdNL($userId);
        
        if ($user) {
            return ['status' => 'success', 'data' => $user];
        } else {
            return ['status' => 'error', 'message' => 'Usuario no encontrado.'];
        }
    }

    public function updateUserNL($userMail, $userName, $userLastname1, $userLastname2, $userActive, $userId){
        if($this->newsletterModel->validateUserExistsNL($userId)){
            $this->newsletterModel->updateUserNL($userMail, $userName, $userLastname1, $userLastname2, $userActive, $userId);
            return ['status' => 'success', 'message' => 'El usuario fue desactivado'];
        }else{
            return ['status' => 'error', 'message' => 'Error al desactivar el usuario.'];
        }
    }
}


?>