<?php

error_reporting(0);

// Definir manipulador de erros personalizado
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

//use App\Controller\AuthController;
require_once './App/Controller/AuthController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $requestData = json_decode(file_get_contents('php://input'), true);

        $data = json_decode(filter_input(INPUT_POST, 'data'));

        // Check if the request is valid
        if (!$data) {
            // launch error 400
            echo json_encode(["status" => "Bad Request", 'ok' => false]);
            exit;
        }

        // Route the request to the right controller
        switch ($data->action) {
            case 'login':
                $authController = new AuthController();
                $authController->login($data->username, $data->password);
                break;

            default:
                // launch error 404
                echo json_encode(["status" => "Not Found", 'ok' => false]);
                break;
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "Error", "message" => $e->getMessage(), "ok" => false]);
    }
}
?>
