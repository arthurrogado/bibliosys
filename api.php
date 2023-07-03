<?php

error_reporting(0);

// Definir manipulador de erros personalizado
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

//use App\Controller\AuthController;
require_once './App/Controller/AuthController.php';
require_once './App/Controller/LeitorController.php';
require_once './App/Controller/CategoriaLeitorController.php';


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

            case 'getLeitor':
                $leitorController = new LeitorController();
                $leitorController->getLeitor($data->id);
                break;
            
            case 'editarLeitor':
                $leitorController = new LeitorController();
                $leitorController->editarLeitor(
                    $data->id,
                    $data->nome, 
                    $data->cpf, 
                    $data->endereco, 
                    $data->cidade, 
                    $data->estado, 
                    $data->telefone, 
                    $data->email, 
                    $data->categoria, 
                    $data->data_nascimento
                );
                break;
            
            case 'deletarLeitor':
                $leitorController = new LeitorController();
                $leitorController->deletarLeitor($data->id);
                break;

            // CATEGORIAS de Leitor
            
            case 'listarCategoriasLeitor':
                $categoriaLeitorController = new CategoriaLeitorController();
                $categoriaLeitorController->getAll();
                break;
            
            case 'getCategoriaLeitor':
                $categoriaLeitorController = new CategoriaLeitorController();
                $categoriaLeitorController->getCategoriaLeitor($data->id);
                break;
            
            case 'createCategoriaLeitor':
                $categoriaLeitorController = new CategoriaLeitorController();
                $categoriaLeitorController->createCategoriaLeitor($data->nome, $data->dias_emprestimo);
                break;
            
            case 'editarCategoriaLeitor':
                $categoriaLeitorController = new CategoriaLeitorController();
                $categoriaLeitorController->updateCategoriaLeitor($data->id, $data->nome, $data->dias_emprestimo);
                break;
            
            case 'deletarCategoriaLeitor':
                $categoriaLeitorController = new CategoriaLeitorController();
                $categoriaLeitorController->deleteCategoriaLeitor($data->id);
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
