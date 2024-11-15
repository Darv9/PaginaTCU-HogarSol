<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if(isset($_POST['action']) && $_POST['action'] === 'updateUser'){
    if(isset($_POST['user_id'], $_POST['userName'], $_POST['userPass'], $_POST['userLastname1'],  $_POST['userLastname2'], $_POST['userMail'], $_POST['user_active'], $_POST['user_role'])){
        $userId = $_POST['user_id'];
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];
        $userLastname1 = $_POST['userLastname1'];
        $userLastname2 = $_POST['userLastname2'];
        $userMail = $_POST['userMail'];
        $userActive = $_POST['user_active'];
        $userRol = $_POST['user_role'];

        try{
            $userController = new UserController();
            $response = $userController->updateUser($userId, $userName, $userPass, $userLastname1, $userLastname2, $userMail, $userActive, $userRol);
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