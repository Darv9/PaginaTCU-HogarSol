<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];


if(isset($_POST['action']) && $_POST['action'] === 'loginUser'){
    if(isset($_POST['userMail'], $_POST['userPass'])){
        $userMail = $_POST['userMail'];
        $userPass = $_POST['userPass'];

        try{
            $userController = new UserController();
            $response = $userController->loginUser($userMail, $userPass);
        } catch(Exception $e) {
            $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Datos no válidos'];
    }
}

echo json_encode($response);
exit;

?>