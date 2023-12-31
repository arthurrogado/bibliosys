<?php

// api.php


error_reporting(0);

// Definir manipulador de erros personalizado
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

//use App\Controller\AuthController;
try {
    require_once './App/Controller/AuthController.php';
    require_once './App/Controller/LeitorController.php';
    require_once './App/Controller/CategoriaLeitorController.php';
    require_once './App/Controller/CategoriaLiterariaController.php';
    require_once './App/Controller/ObraController.php';
    require_once './App/Controller/EmprestimoController.php';
} catch (\Throwable $th) {
    echo json_encode( array('error' => $th->getMessage()) );
}


//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if(isset($_POST['data'])) {
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
                
            case 'getLeitores':
                $leitorController = new LeitorController();
                $leitorController->getLeitores();
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
            
            // Categorias LITERARIAS

            case 'listarCategoriasLiterarias':
                $categoriaLiterariaController = new CategoriaLiterariaController();
                $categoriaLiterariaController->getAll();
                break;
            
            case 'getCategoriaLiteraria':
                $categoriaLiterariaController = new CategoriaLiterariaController();
                $categoriaLiterariaController->getCategoriaLiteraria($data->id);
                break;

            case 'createCategoriaLiteraria':
                $categoriaLiterariaController = new CategoriaLiterariaController();
                $categoriaLiterariaController->createCategoriaLiteraria($data->nome, $data->dias_emprestimo, $data->multa_diaria);
                break;

            case 'editarCategoriaLiteraria':
                $categoriaLiterariaController = new CategoriaLiterariaController();
                $categoriaLiterariaController->updateCategoriaLiteraria($data->id, $data->nome, $data->dias_emprestimo, $data->multa_diaria);
                break;

            case 'deletarCategoriaLiteraria':
                $categoriaLiterariaController = new CategoriaLiterariaController();
                $categoriaLiterariaController->deleteCategoriaLiteraria($data->id);
                break;
                
            // OBRAS LITERARIAS

            case 'criarObra':
                $obraController = new ObraController();
                // $titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas
                $obraController->createObra(
                    $data->titulo, 
                    $data->isbn, 
                    $data->id_categoria_literaria, 
                    $data->autores, 
                    $data->palavras_chave, 
                    $data->data_publicacao, 
                    $data->edicao, 
                    $data->editora, 
                    $data->paginas
                );
                break;

            case 'getObras':
                $obraController = new ObraController();
                $obraController->getObras();
                break;

            case 'getObra':
                $obraController = new ObraController();
                $obraController->getObra($data->id);
                break;

            case 'updateObra':
                $obraController = new ObraController();
                $obraController->updateObra(
                    $data->id,
                    $data->titulo, 
                    $data->isbn, 
                    $data->id_categoria_literaria, 
                    $data->autores, 
                    $data->palavras_chave, 
                    $data->data_publicacao, 
                    $data->edicao, 
                    $data->editora, 
                    $data->paginas
                );
                break;

            case 'deleteObra':
                $obraController = new ObraController();
                $obraController->deleteObra($data->id);
                break;

            // EMPRESTIMOS

            case 'getEmprestimos':
                $emprestimoController = new EmprestimoController();
                $emprestimoController->getEmprestimos();
                break;

            case 'getEmprestimo':
                $emprestimoController = new EmprestimoController();
                $emprestimoController->getEmprestimo($data->id);
                break;

            case 'createEmprestimo':
                // $data_emprestimo, $data_prevista_devolucao, $id_leitor, $id_obra, $id_funcionario_responsavel
                $emprestimoController = new EmprestimoController();
                $emprestimoController->createEmprestimo($data->data_emprestimo, $data->data_prevista_devolucao, $data->id_leitor, $data->id_obra, $data->id_funcionario_responsavel);
                break;

            case 'updateEmprestimo':
                $emprestimoController = new EmprestimoController();
                $emprestimoController->updateEmprestimo($data->id, $data->data_emprestimo, $data->data_prevista_devolucao, $data->id_leitor, $data->id_obra, $data->id_funcionario_responsavel);
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
