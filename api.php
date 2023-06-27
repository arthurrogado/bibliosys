<?php

error_reporting(0);

// Definir manipulador de erros personalizado
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

//use App\Controller\AuthController;
require './App/Controller/AuthController.php';
require_once './App/Controller/ObraController.php';
require_once './App/Controller/ColaboradorController.php';

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

            case 'criar_obra':
                $ObraController = new ObraController();
                $ObraController->criarObra($data->nome, $data->descricao);
                break;

            case 'listar_obras':
                $ObraController = new ObraController();
                $ObraController->listarObras();
                break;

            //---- COLABORADORES

            case 'get_colaborador':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->getColaborador($data->id_colaborador);
                break;

            case 'criar_colaborador':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->criarColaborador($data->nome, $data->cpf, $data->telefone, $data->endereco, $data->diaria, $data->funcao, $data->observacoes);
                break;

            case 'listar_colaboradores':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->getAll();
                break;

            case 'get_colaboradores_nao_linkados':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->getColaboradoresNaoLinkados($data->id_obra);
                break;

            case 'vincular_colaborador_a_obra':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->vincularColaboradorAObra($data->id_colaborador, $data->id_obra);
                break;

            //---- OBRAS
            case 'get_colaboradores_vinculados':
                $ObraController = new ObraController();
                $ObraController->getColaboradores($data->id_obra);
                break;

            case 'get_obra':
                $ObraController = new ObraController();
                $ObraController->getObra($data->id_obra);
                break;

            //---- PONTO
            case 'get_ponto':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->getPonto($data->id_colaborador, $data->id_obra, $data->data);
                break;
            case 'set_ponto':
                $ColaboradorController = new ColaboradorController();
                $ColaboradorController->setPonto($data->id_colaborador, $data->id_obra, $data->data, $data->matutino, $data->vespertino);
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
