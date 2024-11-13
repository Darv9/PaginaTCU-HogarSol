<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if (isset($_GET['action']) && $_GET['action'] === 'getAllUsers') {
    try {
        $userController = new UserController();
        $users = $userController->getAllUsers();

        if ($users) {
            // Aseguramos que los usuarios sean enviados en la clave 'users'
            $response = [
                'status' => 'success',
                'message' => 'Usuarios obtenidos con éxito',
                'users' => $users // Cambiar de 'data' a 'users'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No se encontraron usuarios'
            ];
        }
    } catch (Exception $e) {
        $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
    }
}

echo json_encode($response);
exit;

?>
