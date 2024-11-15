<?php 

require_once '../models/newsletterModel.php';
require_once '../mail/massEmail.php';

class MailController {
    private $newsletterModel;
    private $massEmail;

    public function __construct() {
        $this->newsletterModel = new NewsletterModel();
        $this->massEmail = new MassEmail();
    }

    public function sendMassEmail($subject, $message, $image = null) {
        // Obtener los correos electrónicos de todos los usuarios
        $users = $this->newsletterModel->getAllUsersMail();
        if (empty($users)) {
            return ['status' => 'error', 'message' => 'No se encontraron usuarios para enviar el correo.'];
        }

        // Verificación de la imagen
        if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
            // Imagen válida, proceder a enviar
            $image = $_FILES['imageUpload'];  // Asignar la imagen cargada
            error_log('Imagen recibida: ' . print_r($image, true));
            $this->massEmail->sendMassEmail($users, $subject, $message, $image); // Enviar con imagen
        } else {
            error_log('No se recibió una imagen válida o ocurrió un error en la carga.');
            $this->massEmail->sendMassEmail($users, $subject, $message);  // Sin imagen
        }

        return ['status' => 'success', 'message' => 'Correo enviado a todos los usuarios.'];
    }
}
?>