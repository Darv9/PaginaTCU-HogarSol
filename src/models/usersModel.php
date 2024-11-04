<?php 

require_once '../database/database.php';


class UserModel {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registerUser($userName, $userLastname1, $userLastname2, $userMail){
        $query = "INSERT INTO USERS (USERNAME, USERLASTNAME1, USERLASTNAME2, USERMAIL, USER_CONFIRMATION) VALUES (:USERNAME, :USERLASTNAME1, :USERLASTNAME2, :USERMAIL, :USER_CONFIRMATION)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERNAME', $userName);
        $stmt->bindParam(':USERLASTNAME1', $userLastname1);
        $stmt->bindParam(':USERLASTNAME2', $userLastname2);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->bindParam(':USER_CONFIRMATION', 0);
        return $stmt->execute();
    }

    public function confirmUser($confirmation_code) {
        $query = "UPDATE USERS SET USER_CONFIRMATION = 1 WHERE CONFIRMATION_CODE = :CONFIRMATION_CODE";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':CONFIRMATION_CODE', $confirmation_code);
        return $stmt->execute();
    }
}

?>