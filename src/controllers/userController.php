<?php 

require_once '../models/userModel.php';
require_once '../mail/confirmationMail.php';


class UserController{
    private $userModel;

    public function __construct()
    {
        $this -> userModel = new UserModel();
    }

    public function registerUser($userName, $userPass, $userLastname1, $userLastname2, $userMail){
        //Verificamos si el correo ya existe
        if($this->userModel->checkEmailExists($userMail)){
            return ['status' => 'error', 'message' => 'El correo electrónico ya está registrado.'];
        }

        //Se obtiene el confirmation para enviarlo por correo
        $confirmationCode = $this->userModel->getConfirmCode();

        //Se procede con el registro si no existe
        if($this->userModel->registerUser($userName, $userPass, $userLastname1, $userLastname2, $userMail)){
            //Se envia el correo
            $mail = new ConfirmationMail();
            if($mail->sendConfirmationEmail($userMail, $confirmationCode)){
                return ['status' => 'success', 'message' => 'Correo enviado y registrado correctamente.'];
            } else{
                // Si el correo no se envía, devuelve un error
                return ['status' => 'error', 'message' => 'Error al enviar el correo.'];
            }
        }
        return ['status' => 'error', 'message' => 'Error al registrar.'];
    }

    public function confirmRegister($confirmationCode){
        if($this->userModel->validateRegister($confirmationCode)){
            $this->userModel->updateConfirmation($confirmationCode);
            return ['status' => 'success', 'message' => 'El registro fue confirmado'];
        } else {
            return ['status' => 'error', 'message' => 'Error al confirmar el registro.'];
        }
    }

    public function loginUser($userMail, $userPass) {
        // Intentamos hacer login llamando al método loginUser del modelo
        $user = $this->userModel->loginUser($userMail, $userPass);
    
        // Si el login es exitoso, $user contendrá los datos del usuario
        if ($user) {
            // Iniciamos la sesión y almacenamos los datos necesarios
            session_start();
            $_SESSION['USER_ID'] = $user['USER_ID'];
            $_SESSION['USERMAIL'] = $user['USERMAIL'];
            
            // Retornamos el éxito en un array con un mensaje
            return ['status' => 'success', 'message' => 'Inicio de sesión exitoso.'];
        } else {
            // Si el login falla, retornamos un error en un array
            return ['status' => 'error', 'message' => 'Correo o contraseña incorrectos, o la cuenta no está confirmada.'];
        }
    }
    
}

?>