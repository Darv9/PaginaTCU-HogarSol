<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../controllers/newsletterController.php';

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if (isset($_POST['action']) && $_POST['action'] === 'registerNewsletter') {
    if (isset($_POST['emailNewsletter'], $_POST['usernameNewsletter'], $_POST['userlastname1Newsletter'], $_POST['userlastname2Newsletter'])) {
        $email = $_POST['emailNewsletter'];
        $username = $_POST['usernameNewsletter'];
        $lastname1 = $_POST['userlastname1Newsletter'];
        $lastname2 = $_POST['userlastname2Newsletter'];

        try {
            $newsletterController = new NewsletterController();
            $response = $newsletterController->registerNewsletter($email, $username, $lastname1, $lastname2);
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
