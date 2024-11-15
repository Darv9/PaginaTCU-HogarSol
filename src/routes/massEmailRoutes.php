<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Verificar si el archivo PHP existe antes de incluirlo
if (!file_exists('../controllers/mailController.php')) {
    echo json_encode(['status' => 'error', 'message' => 'El archivo mailController.php no existe']);
    exit;
}

require_once '../controllers/mailController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

// Verificar que la acción esté presente y sea la correcta
if (isset($_POST['action']) && $_POST['action'] === 'sendMassEmail') {
    if (isset($_POST['subject'], $_POST['message'])) {
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Verificar si se ha subido un archivo de imagen
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Validar el archivo de imagen (por ejemplo, que sea una imagen válida)
            $image = $_FILES['image'];
        }

        try {
            // Instanciamos el controlador
            $mailController = new MailController();
            // Pasamos la imagen al controlador de envío masivo
            $response = $mailController->sendMassEmail($subject, $message, $image);
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