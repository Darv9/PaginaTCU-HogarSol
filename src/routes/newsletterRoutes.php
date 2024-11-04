<?php
require_once '../controllers/newsletterController.php';

header('Content-Type: application/json');

$newsletterController = new NewsletterController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'registerNewsletter') {
        $userMail = $_POST['emailNewsletter'];
        $userName = $_POST['usernameNewsletter'];
        $userLastname1 = $_POST['userlastname1Newsletter'];
        $userLastname2 = $_POST['userlastname2Newsletter'];
        $success = $newsletterController->registerNewsletter($userName, $userLastname1, $userLastname2, $userMail);
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }
}

?>