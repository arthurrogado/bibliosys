<?php

error_reporting(0);

// Definir manipulador de erros personalizado
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

//use App\Controller\AuthController;
require_once './App/Controller/AuthController.php';
require_once './App/Controller/LeitorController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
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


            // LEITORES
                
            case 'listarLeitores':
                $leitorController = new LeitorController();
                $leitorController->listarLeitores();
                break;

            case 'cadastrarLeitor':
                $leitorController = new LeitorController();
                $leitorController->cadastrarLeitor($data->nome, $data->endereco, $data->telefone, $data->email, $data->cpf, $data->categoria, $data->data_nascimento);
                break;

            default:
                // launch error 404
                echo json_encode(["status" => "Not Found", 'ok' => false, "message" => "Ação não encontrada"]);
                break;
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "Error", "message" => $e->getMessage(), "line" => $e->getLine(), "ok" => false]);
    }
}
?>
