<?php 

require_once '../controllers/userController.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $userController = new UserController();
    $result = $userController->confirmRegister($code);
    if($result['status'] === 'success'){
        header("Location: ../mail/templates/registerConfirmed.html");
        exit();
    } else {
        header("Location: ../mail/templates/registerConfirmationError.html");
        exit();
    }
} else {
    header("Location: ../mail/templates/registerConfirmationError.html");
    exit();
}
?>
