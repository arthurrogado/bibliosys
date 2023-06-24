<?php

//use App\Controller\AuthController;
require './App/Controller/AuthController.php';
require_once './App/Controller/ObraController.php';
require_once './App/Controller/ColaboradorController.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requestData = json_decode(file_get_contents('php://input'), true);

    $data = json_decode(filter_input(INPUT_POST, 'data'));
    
    // Check if the request is valid
    if(!$data) {
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
        
        default:
            // launch error 404
            echo json_encode(["status" => "Not Found", 'ok' => false]);
            break;
    }

}

?>