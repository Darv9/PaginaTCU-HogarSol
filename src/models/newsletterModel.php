<?php 

require_once '../database/database.php';


class NewsletterModel {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registerNewsletter($userMail, $userName, $userLastname1, $userLastname2){
        $query = "INSERT INTO NEWSLETTER (USERMAIL, USERNAME, USERLASTNAME1, USERLASTNAME2) VALUES (:USERMAIL, :USERNAME, :USERLASTNAME1, :USERLASTNAME2)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':USERMAIL', $userMail);
        $stmt->bindParam(':USERNAME', $userName);
        $stmt->bindParam(':USERLASTNAME1', $userLastname1);
        $stmt->bindParam(':USERLASTNAME2', $userLastname2);
        return $stmt->execute();
    }
}

?>