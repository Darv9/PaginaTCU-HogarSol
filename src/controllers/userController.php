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

    public function deactivateUser($userId){
        if($this->userModel->validateUserExists($userId)){
            $this->userModel->deactivateUser($userId);
            return ['status' => 'success', 'message' => 'El usuario fue desactivado'];
        }else{
            return ['status' => 'error', 'message' => 'Error al desactivar el usuario.'];
        }
    }

    public function updateUser($userId, $userName, $userPass, $userLastname1, $userLastname2, $userMail, $userActive, $userRol){
        if($this->userModel->validateUserExists($userId)){
            $this->userModel->updateUser($userName, $userPass, $userLastname1, $userLastname2, $userMail, $userActive, $userRol, $userId);
            return ['status' => 'success', 'message' => 'El usuario fue desactivado'];
        }else{
            return ['status' => 'error', 'message' => 'Error al desactivar el usuario.'];
        }
    }

    public function loginUser($userMail, $userPass) {
        // Intentamos hacer login llamando al método loginUser del modelo
        $loginResult = $this->userModel->loginUser($userMail, $userPass);
        
        // Revisamos el resultado del login
        if (is_array($loginResult)) {
            // Si el resultado es un array, es un login exitoso
            session_start();
            $_SESSION['USER_ID'] = $loginResult['USER_ID'];
            $_SESSION['USERMAIL'] = $loginResult['USERMAIL'];
            
            // Retornamos éxito
            return ['status' => 'success', 'message' => 'Inicio de sesión exitoso.'];
        } else {
            // Si el login falla, $loginResult contendrá un error específico
            switch ($loginResult) {
                case 'not_confirmed':
                    return ['status' => 'error', 'message' => 'Cuenta no confirmada. Revise su corre electrónico y confirme su registro.'];
                case 'not_active':
                    return ['status' => 'error', 'message' => 'Cuenta desactivada. Contacte con un administrador.'];
                case 'not_admin':
                    return ['status' => 'error', 'message' => 'No tienes permisos de administrador.'];
                case 'invalid_credentials':
                default:
                    return ['status' => 'error', 'message' => 'Correo o contraseña incorrectos.'];
            }
        }
    }
    

    public function getAllUsers() {
        // Llamamos al método getAllUsers del modelo para obtener los datos
        $users = $this->userModel->getAllUsers();
    
        // Verificamos si obtuvimos resultados
        if ($users) {
            return ['status' => 'success', 'data' => $users];
        } else {
            return ['status' => 'error', 'message' => 'No se encontraron usuarios.'];
        }
    }

    public function getUserById($userId) {
        $user = $this->userModel->getUserById($userId);
        
        if ($user) {
            return ['status' => 'success', 'data' => $user];
        } else {
            return ['status' => 'error', 'message' => 'Usuario no encontrado.'];
        }
    }
    
    
}

?>