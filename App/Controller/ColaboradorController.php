<?php

// ColaboradorController.php

require_once './App/Model/Colaborador.php';

class ColaboradorController {
    
    public function criarColaborador($nome, $cpf, $telefone, $endereco, $diaria, $funcao, $observacoes) {
        $colaborador = new Colaborador();
        $response = $colaborador->criarColaborador($nome, $cpf, $telefone, $endereco, $diaria, $funcao, $observacoes);
        if($response) {
            echo json_encode(["status" => "Colaborador criado com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao criar colaborador", "ok" => false]);
        }
    }

    public function getAll() {
        $colaborador = new Colaborador();
        $response = $colaborador->getAll();
        if($response) {
            echo json_encode(["status" => "Colaboradores listados com sucesso", "ok" => true, "colaboradores" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar colaboradores", "ok" => false]);
        }
    }

    // Pega os colaboradores que não estão linkados a uma determinada obra
    public function getColaboradoresNaoLinkados($id_obra) {
        $colaborador = new Colaborador();
        $response = $colaborador->getNaoVinculado($id_obra);
        if($response) {
            echo json_encode(["status" => "Colaboradores listados com sucesso", "ok" => true, "colaboradores" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar colaboradores", "ok" => false]);
        }
    }

    public function vincularColaboradorAObra($id_colaborador, $id_obra) {
        $colaborador = new Colaborador();
        $response = $colaborador->vincularAObra($id_colaborador, $id_obra);
        if($response) {
            echo json_encode(["status" => "Colaborador vinculado com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao vincular colaborador", "ok" => false]);
        }
    }

}

?>