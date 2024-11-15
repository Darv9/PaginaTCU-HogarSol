<?php 

require_once '../database/database.php';

class UserModel{
    private $db;        
    private $confirmationCode;
    
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        //Se genera el codigo de confirmacion  
        do{
            $this->confirmationCode = bin2hex(random_bytes(16));;
        } while ($this->checkCodeExists($this->confirmationCode));
    }

    //Para poder obtener el codigo para el correo en la clase controller
    public function getConfirmCode(){
        return $this->confirmationCode;
    }

    public function checkEmailExists($userMail){
        $query = "SELECT COUNT(*) FROM USERS WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true si el correo ya existe
    }

    public function checkCodeExists($confirmation_code){
        $query = "SELECT COUNT(*) FROM USERS WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirmation_code);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true si el codigo ya existe
    }

    public function registerUser($userName, $userPass, $userLastname1, $userLastname2, $userMail){
        
        $hashed_pass = password_hash($userPass, PASSWORD_DEFAULT);

        $confirmation_code = $this->confirmationCode;

        $query = "INSERT INTO USERS (USERNAME, USERPASS, USERLASTNAME1, USERLASTNAME2, USERMAIL, CONFIRMATION_CODE, USER_CONFIRMATION, ROLE_ID, USER_ACTIVE) 
                    VALUES (:USERNAME, :USERPASS, :USERLASTNAME1, :USERLASTNAME2, :USERMAIL, :CONFIRMATION_CODE, :USER_CONFIRMATION, :ROLE_ID, :USER_ACTIVE)";

        $stmt = $this->db->prepare($query);
        $userRole = 2; //Valor predeterminado del rol
        $userConfirmation = 0; //Valor predeterminado del confirmationUser
        $userActive = 1; //Valor predeterminado para el campo userActive

        $stmt->bindParam('USERNAME', $userName);
        $stmt->bindParam('USERPASS', $hashed_pass);
        $stmt->bindParam('USERLASTNAME1', $userLastname1);
        $stmt->bindParam('USERLASTNAME2', $userLastname2);
        $stmt->bindParam('USERMAIL', $userMail);
        $stmt->bindParam('CONFIRMATION_CODE', $confirmation_code);
        $stmt->bindParam('USER_CONFIRMATION', $userConfirmation);
        $stmt->bindParam('ROLE_ID', $userRole);
        $stmt->bindParam('USER_ACTIVE', $userActive);

        return $stmt->execute();
    }

    public function validateRegister($confirm_code){
        $query = "SELECT * FROM USERS WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirm_code);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true si el codigo se encuentra 
    }
    
    public function validateUserExists($userId){
        $query = "SELECT * FROM USERS WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true, si encuentra el user
    }

    public function updateConfirmation($confirm_code){
        $user_confirmation = 1;
        $query = "UPDATE USERS SET USER_CONFIRMATION = :USER_CONFIRMATION WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_CONFIRMATION', $user_confirmation);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirm_code);
        $stmt->execute();
    }

    public function deactivateUser($userId){
        $userActive = 0;
        $query = "UPDATE USERS SET USER_ACTIVE = :USER_ACTIVE WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ACTIVE', $userActive);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
    }
    
    public function updateUser($userName, $userPass, $userLastname1, $userLastname2, $userMail, $userActive, $userRol, $userId){
        // Si la contraseña está vacía, obtenemos la contraseña actual de la base de datos
        if (empty($userPass)) {
            $query = "SELECT USERPASS FROM USERS WHERE USER_ID = :USER_ID";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':USER_ID', $userId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $userPass = $result['USERPASS']; // Usamos la contraseña actual si no se envió una nueva
        } else {
            $userPass = password_hash($userPass, PASSWORD_DEFAULT); // Hasheamos la nueva contraseña si se ha enviado
        }
    
        $query = "UPDATE USERS SET USERNAME = :USERNAME, USERPASS = :USERPASS, USERLASTNAME1 = :USERLASTNAME1, USERLASTNAME2 = :USERLASTNAME2, USERMAIL = :USERMAIL, USER_ACTIVE = :USER_ACTIVE, ROLE_ID = :ROLE_ID WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->bindParam(':USERNAME', $userName);
        $stmt->bindParam(':USERPASS', $userPass);
        $stmt->bindParam(':USERLASTNAME1', $userLastname1);
        $stmt->bindParam(':USERLASTNAME2', $userLastname2);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->bindParam(':USER_ACTIVE', $userActive);
        $stmt->bindParam(':ROLE_ID', $userRol);
        $stmt->execute();
    }
    
    

    public function loginUser($userMail, $userPass){
        $query = "SELECT USER_ID, USERMAIL, USERPASS, USER_CONFIRMATION, ROLE_ID, USER_ACTIVE FROM USERS WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();
    
        // Obtener la información del usuario
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si el usuario existe
        if ($user) {
            // Verificar si la cuenta está confirmada
            if ($user['USER_CONFIRMATION'] != 1) {
                return 'not_confirmed'; // Usuario no confirmado
            }
            
            // Verificar si el usuario está activo
            if ($user['USER_ACTIVE'] != 1) {
                return 'not_active'; // Usuario inactivo
            }
    
            // Verificar si el usuario es administrador (ROLE_ID == 1 por ejemplo)
            if ($user['ROLE_ID'] != 1) {
                return 'not_admin'; // Usuario no es administrador
            }
    
            // Verificar la contraseña
            if (password_verify($userPass, $user['USERPASS'])) {
                return [
                    'USER_ID' => $user['USER_ID'],
                    'USERMAIL' => $userMail
                ];
            }
        }
    
        return 'invalid_credentials'; // Credenciales inválidas (correo o contraseña incorrectos)
    }
    

    public function getAllUsers(){
        $query = "SELECT USER_ID, USERNAME, USERLASTNAME1, USERLASTNAME2, USERMAIL, USER_CONFIRMATION, ROLE_ID, USER_ACTIVE FROM USERS";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los registros en un array asociativo
    }

    public function getUserById($userId){
        $query = "SELECT USER_ID, USERNAME, USERLASTNAME1, USERLASTNAME2, USERMAIL, USER_CONFIRMATION, ROLE_ID, USER_ACTIVE FROM USERS WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los registros en un array asociativo
    }

    public function getAllUsersMail(){
        $query = "SELECT USERMAIL FROM USERS";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>