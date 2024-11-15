<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/newsletterController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deactivateUserNL') {
    try {
        if (isset($_POST['userMail'])) {
            $userMail = $_POST['userMail'];
            
            // Inicializa el controlador
            $newsletterControler = new NewsletterController();
            
            // Llama al método deactivateUser en el controlador y guarda la respuesta
            $response = $newsletterControler->deactivateUserNL($userMail);
        } else {
            $response = ['status' => 'error', 'message' => 'Correo del usuario no especificado.'];
        }
    } catch (Exception $e) {
        $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
    }
}

echo json_encode($response);
exit;

?>
