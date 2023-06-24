<?php

// ObraController.php

require_once './App/Model/Obra.php';

class ObraController {
    
    public function criarObra($nome, $descricao) {
        $obra = new Obra();
        $response = $obra->criarObra($nome, $descricao);
        if($response) {
            echo json_encode(["status" => "Obra criada com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao criar obra", "ok" => false]);
        }
    }

    public function listarObras() {
        $obra = new Obra();
        $response = $obra->listarObras();
        if($response) {
            echo json_encode(["status" => "Obras listadas com sucesso", "ok" => true, "obras" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar obras", "ok" => false]);
        }
    }

    public function getColaboradores($id_obra) {
        $obra = new Obra();
        $obra->setId($id_obra);
        $response = $obra->getColaboradores();
        if($response) {
            echo json_encode(["status" => "Colaboradores listados com sucesso", "ok" => true, "colaboradores" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar colaboradores", "ok" => false]);
        }
    }

    public function getObra($id_obra) {
        $obra = new Obra();
        $response = $obra::getObra($id_obra);
        if($response) {
            echo json_encode(["status" => "Obra listada com sucesso", "ok" => true, "obra" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar obra", "ok" => false]);
        }
    }

}

?>