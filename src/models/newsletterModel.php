<?php 

require_once '../database/database.php';


class NewsletterModel {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function checkEmailExists($userMail) {
        $query = "SELECT COUNT(*) FROM NEWSLETTER WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Retorna true si el correo existe
    }
    
    public function registerNewsletter($userMail, $userName, $userLastname1, $userLastname2){
        $userActive = 1;
        $query = "INSERT INTO NEWSLETTER (USERMAIL, USERNAME, USERLASTNAME1, USERLASTNAME2, USER_ACTIVE) VALUES (:USERMAIL, :USERNAME, :USERLASTNAME1, :USERLASTNAME2, :USER_ACTIVE)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->bindParam(':USERNAME', $userName);
        $stmt->bindParam(':USERLASTNAME1', $userLastname1);
        $stmt->bindParam(':USERLASTNAME2', $userLastname2);
        $stmt->bindParam(':USER_ACTIVE', $userActive);
        return $stmt->execute();
    }

    public function getAllNewsltterUsers(){
        $query = "SELECT USERMAIL, USERNAME, USERLASTNAME1, USERLASTNAME2, USER_ACTIVE, USER_ID FROM NEWSLETTER";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkMailExists($userMail){
        $query = "SELECT COUNT(*) FROM NEWSLETTER WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true si el codigo ya existe
    }

    public function deactivateUserNL($userMail){
        $userActive = 0;
        $query = "UPDATE NEWSLETTER SET USER_ACTIVE = :USER_ACTIVE WHERE USERMAIL = :USERMAIL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ACTIVE', $userActive);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->execute();
    }

    public function updateUserNL($userMail, $userName, $userLastname1, $userLastname2, $userActive, $userId){
        $query = "UPDATE NEWSLETTER SET USERMAIL = :USERMAIL, USERNAME = :USERNAME, USERLASTNAME1 = :USERLASTNAME1, USERLASTNAME2 = :USERLASTNAME2, USER_ACTIVE = :USER_ACTIVE WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->bindParam(':USERNAME', $userName);
        $stmt->bindParam(':USERLASTNAME1', $userLastname1);
        $stmt->bindParam(':USERLASTNAME2', $userLastname2);
        $stmt->bindParam(':USER_ACTIVE', $userActive);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
    }

    public function getUserByIdNL($userId){
        $query = "SELECT USER_ID, USERMAIL, USERNAME, USERLASTNAME1, USERLASTNAME2, USER_ACTIVE FROM NEWSLETTER WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los registros en un array asociativo
    }

    public function validateUserExistsNL($userId){
        $query = "SELECT * FROM NEWSLETTER WHERE USER_ID = :USER_ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USER_ID', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; //retorna true, si encuentra el user
    }
}

?>