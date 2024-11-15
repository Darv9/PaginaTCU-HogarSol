<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/newsletterController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if(isset($_POST['action']) && $_POST['action'] === 'updateUserNL'){
    if(isset($_POST['user_id'], $_POST['userName'], $_POST['userLastname1'],  $_POST['userLastname2'], $_POST['userMail'], $_POST['user_active'])){
        $userName = $_POST['userName'];
        $userLastname1 = $_POST['userLastname1'];
        $userLastname2 = $_POST['userLastname2'];
        $userMail = $_POST['userMail'];
        $userActive = $_POST['user_active'];
        $userId = $_POST['user_id'];

        try{
            $newsletterController = new NewsletterController();
            $response = $newsletterController->updateUserNL($userMail, $userName, $userLastname1, $userLastname2, $userActive, $userId);
        } catch(Exception $e){
            $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
        }
    } else { 
        $response = ['status' => 'error', 'message' => 'Datos no válidos'];
    }
}


echo json_encode($response);
exit;

?>