<?php
require_once '../controllers/usersController.php';

header('Content-Type: application/json');

$userController = new UsersController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'register') {
        $userName = $_POST['userName'];
        $userLastname1 = $_POST['userLastname1'];
        $userLastname2 = $_POST['userLastname2'];
        $userMail = $_POST['userMail'];
        $success = $userController->registerUser($userName, $userLastname1, $userLastname2, $userMail);
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }

    if ($action === 'confirm') {
        $confirmation_code = $_POST['confirmation_code'];
        $success = $userController->confirmUser($confirmation_code);
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }
}

?>