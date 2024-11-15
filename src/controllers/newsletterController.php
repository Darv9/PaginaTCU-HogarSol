<?php

require_once '../models/newsletterModel.php';
require_once '../mail/newsletterMail.php';

class NewsletterController {
    private $newsletterModel;

    public function __construct() {
        $this->newsletterModel = new NewsletterModel();
    }

    public function registerNewsletter($userMail, $userName, $userLastname1, $userLastname2) {
        // Verifica si el correo ya está registrado
        if ($this->newsletterModel->checkEmailExists($userMail)) {
            // Si el correo está registrado y activo, no se hace nada
            $emailStatus = $this->newsletterModel->checkEmailActive($userMail);
    
            if ($emailStatus === 1) {
                return ['status' => 'success', 'message' => 'El correo electrónico ya está registrado y activo.'];
            }
    
            // Si el correo está inactivo, lo reactiva
            if ($emailStatus === 0) {
                $this->newsletterModel->reactivateEmail($userMail);
                return ['status' => 'success', 'message' => 'Usuario reactivado!'];
            }
        } else {
            // Si el correo no está registrado, se procede con el registro
            if ($this->newsletterModel->registerNewsletter($userMail, $userName, $userLastname1, $userLastname2)) {
                // Envía el correo de confirmación
                $mail = new NewsLetterMail();
                if ($mail->sendConfirmationNewsletterMail($userMail, $userName)) {
                    return ['status' => 'success', 'message' => 'Correo registrado correctamente y correo de confirmación enviado.'];
                } else {
                    return ['status' => 'error', 'message' => 'Error al enviar el correo de confirmación.'];
                }
            }
        }
    
        return ['status' => 'error', 'message' => 'Error al registrar el usuario. Usuario ya existe y se encuentra activo'];
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