<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if(isset($_POST['action']) && $_POST['action'] === 'registerUser'){
    if(isset($_POST['userName'], $_POST['userPass'], $_POST['userLastname1'],  $_POST['userLastname2'], $_POST['userMail'])){
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];
        $userLastname1 = $_POST['userLastname1'];
        $userLastname2 = $_POST['userLastname2'];
        $userMail = $_POST['userMail'];

        try{
            $userController = new UserController();
            $response = $userController->registerUser($userName, $userPass, $userLastname1, $userLastname2, $userMail);
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