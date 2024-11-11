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

        $query = "INSERT INTO USERS (USERNAME, USERPASS, USERLASTNAME1, USERLASTNAME2, USERMAIL, CONFIRMATION_CODE, USER_CONFIRMATION, ROLE_ID) 
                    VALUES (:USERNAME, :USERPASS, :USERLASTNAME1, :USERLASTNAME2, :USERMAIL, :CONFIRMATION_CODE, :USER_CONFIRMATION, :ROLE_ID)";

        $stmt = $this->db->prepare($query);
        $userRole = 2; //Valor predeterminado del rol
        $userConfirmation = 0; //Valor predeterminado del confirmationUser

        $stmt->bindParam('USERNAME', $userName);
        $stmt->bindParam('USERPASS', $hashed_pass);
        $stmt->bindParam('USERLASTNAME1', $userLastname1);
        $stmt->bindParam('USERLASTNAME2', $userLastname2);
        $stmt->bindParam('USERMAIL', $userMail);
        $stmt->bindParam('CONFIRMATION_CODE', $confirmation_code);
        $stmt->bindParam('USER_CONFIRMATION', $userConfirmation);
        $stmt->bindParam('ROLE_ID', $userRole);

        return $stmt->execute();
    }

    public function validateRegister($confirm_code){
        $query = "SELECT * FROM USERS WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirm_code);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true si el codigo se encuentra 
    }

    public function updateConfirmation($confirm_code){
        $user_confirmation = 1;
        $query = "UPDATE USERS SET USER_CONFIRMATION = :USER_CONFIRMATION WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_CONFIRMATION', $user_confirmation);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirm_code);
        $stmt->execute();
    }

    public function loginUser($userMail, $userPass){
        $query = "SELECT USER_ID, USERMAIL, USERPASS, USER_CONFIRMATION, ROLE_ID FROM USERS WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();

        // Obtener la información del usuario
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la cuenta está confirmada
        if ($user && $user['USER_CONFIRMATION'] == 1 && $user['ROLE_ID'] == 2) {
            // Verificar la contraseña
            if (password_verify($userPass, $user['USERPASS'])) {
                return [
                    'USER_ID' => $user['USER_ID'],
                    'USERMAIL' => $userMail
                ];
            }      
        }
        
        return null; // Usuario no encontrado o cuenta no confirmada
    }
}

?>