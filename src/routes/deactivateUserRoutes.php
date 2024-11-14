<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deactivateUser') {
    try {
        if (isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];
            
            // Inicializa el controlador
            $userController = new UserController();
            
            // Llama al método deactivateUser en el controlador y guarda la respuesta
            $response = $userController->deactivateUser($userId);
        } else {
            $response = ['status' => 'error', 'message' => 'ID del usuario no especificado.'];
        }
    } catch (Exception $e) {
        $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
    }
}

echo json_encode($response);
exit;

?>
