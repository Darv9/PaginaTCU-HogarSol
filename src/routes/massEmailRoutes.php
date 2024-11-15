<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/userController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

// Verificamos que la acción sea "sendMassEmail" y que los datos necesarios estén presentes
if (isset($_POST['action']) && $_POST['action'] === 'sendMassEmail') {
    if (isset($_POST['subject'], $_POST['message'])) {
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        try {
            // Creamos una instancia del controlador de usuario
            $userController = new UserController();

            // Llamamos al método para enviar el correo masivo
            $response = $userController->sendMassEmail($subject, $message);
        } catch (Exception $e) {
            $response = ['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Datos no válidos'];
    }
}

echo json_encode($response);
exit;

?>
