<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/newsletterController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if (isset($_GET['action'])) {
    // Obtener un solo usuario por ID
    if ($_GET['action'] === 'getUserByIdNL' && isset($_GET['userId'])) {
        try {
            $newsletterController = new NewsletterController();
            $user = $newsletterController->getUserByIdNL($_GET['userId']); // Pasamos el ID del usuario

            if ($user) {
                $response = [
                    'status' => 'success',
                    'message' => 'Usuario obtenido con éxito',
                    'user' => $user // Retornamos el usuario encontrado
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No se encontró el usuario con el ID proporcionado'
                ];
            }
        } catch (Exception $e) {
            $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
        }
    }
}

echo json_encode($response);
exit;

?>

